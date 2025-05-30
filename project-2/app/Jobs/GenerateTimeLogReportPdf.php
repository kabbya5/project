<?php

namespace App\Jobs;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use setasign\Fpdi\Fpdi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\TimeLogReportMail;


class GenerateTimeLogReportPdf implements ShouldQueue
{
    use Queueable;

    protected $date;
    protected $project_id;
    protected $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct($date,$project_id, $user_id)
    {
        $this->date = $date;
        $this->project_id = $project_id;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $date= $this->date;
            $user_id = $this->user_id;
            $project_id = $this->project_id;

            $directory = storage_path('app/pdfs');
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }

            $chunkSize = 600;

            DB::table('time_logs')->join('projects', 'time_logs.project_id', '=', 'projects.id')
                ->where('time_logs.user_id',$user_id)
                ->when($date, function($q) use ($date){
                    $q->whereDate('time_logs.date', $date);
                })->when($project_id, function($q) use ($project_id){
                    $q->where('time_logs.project_id', $project_id);
                })
                ->select(
                    'projects.title as project',
                    'time_logs.start_time as start_time',
                    'time_logs.end_time as end_time',
                    'time_logs.hours as hours',
                )->orderBy('start_time')
                ->chunk($chunkSize, function($time_logs,$index) use($directory, $chunkSize){
                    $pdfContent = view('pdf', compact('time_logs'))->render();
                    $pdfPath = "{$directory}/_time_logs_{$index}.pdf";
                    $pdf = Pdf::loadHTML($pdfContent);
                    $pdf->save($pdfPath);
                });

            $this->mergePDFs($directory);
        } catch (Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());

        }
    }

     private function mergePDFs($directory)
    {
        $pdfMerger = new Fpdi();

        $pdfFiles = glob("{$directory}/_time_logs_*.pdf");

        foreach ($pdfFiles as $file) {
            $pageCount = $pdfMerger->setSourceFile($file);

            for ($page = 1; $page <= $pageCount; $page++) {
                $templateId = $pdfMerger->importPage($page);
                $pdfMerger->AddPage();
                $pdfMerger->useTemplate($templateId);
            }
        }

        $mergedPdfPath = "{$directory}/merged_report_" . time() . ".pdf";
        $pdfMerger->Output($mergedPdfPath, 'F');

        $recipientEmail = DB::table('users')->where('id', $this->user_id)->value('email');
        Mail::to($recipientEmail)->send(new TimeLogReportMail($mergedPdfPath));

        foreach ($pdfFiles as $file) {
            unlink($file);
        }
    }
}
