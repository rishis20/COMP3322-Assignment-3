const form = document.getElementsByClassName("send-message-form")[0];
const container = document.getElementById("container");
const username = document.getElementById("username").innerHTML;

const loadMessages = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "./chatmsg.php", true);

  let latesttime;
  xhr.onload = async function () {
    if (xhr.status >= 200 && xhr.status < 400) {
      var response = JSON.parse(xhr.responseText);
      let i = 0;
      for (i = 0; i < response.length; i++) {
        container.innerHTML += `
          <div id="${
            response[i].person === username ? "sent-messages" : "received-messages"
          }">
            <span class="sender-receiver" style="display: ${response[i].person === username ? 'none' : 'block'}">${response[i].person}</span>
            <p>${response[i].message}</p>
            <span class="timestamp">${response[i].time}</span>
          </div>
          `;
      }
      container.scrollTop = container.scrollHeight;
      let latesttime;
      if (response.length != 0) {
        latesttime = await response[i - 1].time;
      }
      setInterval(() => {
        var xhr = new XMLHttpRequest();
        var url = "./chatmsg.php";
        var data = JSON.stringify({
          latest: "yes",
          time: latesttime ? latesttime : "00:00:00",
        });
        container.scrollTop = container.scrollHeight;

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/json");

        xhr.onload = async function () {
          var response = JSON.parse(xhr.responseText);
          if (response.length != 0) {
            let a;
            for (a = 0; a < response.length; a++) {
              container.innerHTML += `
                <div id="received-messages">
                <span class="sender-receiver" style="display: ${response[a].person === username ? 'none' : 'block'}">${response[a].person}</span>
                  <p>${response[a].message}</p>
                  <span class="timestamp">${response[a].time}</span>
                </div>
              `;
            }
            container.scrollTop = container.scrollHeight;
            latesttime = await response[a - 1].time;
          }
        };
        xhr.send(data);

        container.scrollTop = container.scrollHeight;
      }, 5000);
    }
  };
  xhr.send();
  container.scrollTop = container.scrollHeight;
};

form.addEventListener("submit", function (e) {
  e.preventDefault();
  const messageInput = document.getElementById("message").value;
  var xhr = new XMLHttpRequest();
  var url = "./chatmsg.php";
  var data = JSON.stringify({
    message: messageInput,
  });

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/json");

  xhr.send(data);

  container.innerHTML += `
    <div id="sent-messages">
      <p>${messageInput}</p>
      <span class="timestamp">${new Date().toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
        timeZone: 'UTC'
      })}</span>
    </div>
    `;

  container.scrollTop = container.scrollHeight;
});
