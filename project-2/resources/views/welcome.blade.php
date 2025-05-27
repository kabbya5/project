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
    <h4>Token-Based Auth API – JSON Samples</h4>


    <p> /register </p>

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

  <p> /departments (post) </p>

  <p> Create </p>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
      { "name": "Software Development"}
    </pre>
  </div>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
      { "name": "Technical Support" }
    </pre>
  </div>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
      { "name": "IT Operations" }
    </pre>
  </div>

   <p> /departments/{id} (put) </p>

  <p> update </p>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
      { "name": "Software Development update"}
    </pre>
  </div>


   <p> /departments/{id} (delete) </p>

  <p> Delete </p>

  <div class="json-box">
    <button class="copy-btn" data-target="deleteJson">Copy</button>
    <pre id="deleteJson">
      { "name": "Software Development update"}
    </pre>
  </div>

   <p> /tickets/ (posts) </p>

  <p> Supmit Titcket </p>

  <div class="json-box">
    <button class="copy-btn" data-target="submitjson">Copy</button>
    <pre id="submitjson">
      {
        "title": "Cannot login to account",
        "description": "I am unable to login since yesterday.",
        "department_id": 1
      }

    </pre>
  </div>

  <p> For file update it should be attathment field name </p>

  <p>/tickets/{id}/status {put) </p>

  <p> Ticket status change </p>


  <div class="json-box">
    <button class="copy-btn" data-target="submitjson">Copy</button>
    <pre id="submitjson">
      {
        {"status":"in_progress"}
      }

    </pre>
  </div>

  <p>tickets/{id}/notes</p>
  <p> Add note </p>

  <div class="json-box">
    <button class="copy-btn" data-target="submitjson">Copy</button>
    <pre id="submitjson">
      {
        {"note":"note"}
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
