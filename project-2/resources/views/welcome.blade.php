<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Token-Based Auth API – JSON Samples</title>
  <style>
    .json-box {
      background: #f5f5f5;
      padding: 1em;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-family: monospace;
      position: relative;
      margin-bottom: 20px;
    }
    .copy-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 5px 10px;
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    .notify {
      position: fixed;
      top: 10px;
      right: 10px;
      background: #28a745;
      color: white;
      padding: 8px 12px;
      border-radius: 5px;
      display: none;
    }
  </style>
</head>
<body>
    <h4>JSON Samples</h4>


    <p> /register (post) </p>

    <p>Create User</p>

    <div class="json-box">
        <button class="copy-btn" data-target="createJson">Copy</button>
        <pre id="createJson">
            {
                "name": "Alice",
                "email": "alice@example.com",
                "password": "password1",
            }
        </pre>
    </div>

    <p> /login</p>

    <p>Login User</p>

    <div class="json-box">
        <button class="copy-btn" data-target="loginJson">Copy</button>
        <pre id="loginJson">
            {
            "email": "alice@example.com",
            "password": "password1"
            }
        </pre>
    </div>


    <p> /logout (post) </p>

    <p> Logout User</p>

    <div class="json-box">
        <button class="copy-btn" data-target="deleteJson">Copy</button>
        <pre id="deleteJson">
            Key: Authorization
            Value: Login Token
        </pre>
  </div>

    <p> / Time Log </p>

    <p> Filter By Day Week  </p>
    <p> api/time-logs {get}</p>

    <div class="json-box">
        <button class="copy-btn" data-target="deleteJson">Copy</button>
        <pre id="deleteJson">
        {
            "date": "2025-05-27",
            "type": "week"
        }
        </pre>
    </div>

  <p> Store </p>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
    {
        "project_id": 1,
        "tag": "billable",
        "start_time": "2025-05-28 09:00:00",
        "description": "Worked on frontend module for client dashboard.",
    }
    </pre>
  </div>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
      { "name": "Technical Support" }
    </pre>
  </div>

  <p> time-logs/update/{time_log} (put) </p>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
        {
            "project_id": 1,
            "tag": "billable",
            "start_time": "2025-05-28 09:00:00",
            "description": "Worked on frontend module for client dashboard.",
            "end_time": "2025-05-28 17:30:00",
            "hours": 8.5
        }
    </pre>
  </div>

   <p> time-logs/end/{time_log} (put) </p>

  <p> End </p>

   <p> /Poject Report (get) </p>

  <p> Delete </p>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
        {
            "client_id":"1",
            "from_date":"2025-05-12",
            "to_date":"2025-05-12"
        }
    </pre>
  </div>

  <div class="notify" id="notify">Copied!</div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $('.copy-btn').on('click', function () {
      const jsonBox = $(this).closest('.json-box'); // Get parent box
      const preText = jsonBox.find('pre').text().trim(); // Get <pre> text only

      navigator.clipboard.writeText(preText).then(() => {
        $('#notify').fadeIn();
        setTimeout(() => {
          $('#notify').fadeOut();
        }, 2000);
      });
    });
  </script>
</body>
</html>
