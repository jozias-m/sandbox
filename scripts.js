// Jozias Mijova (c) 2025
let ip;
let k = 0;

function onload() {
    console.log("");
}
function toggleDarkMode() {
    var element = document.body;
    element.classList.toggle("darkMode");
    element.classList.toggle("lightMode");
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
setTimeout(() => {
    onload()
}, 10);

async function getIP() {
    try {
        const response = await fetch('https://api.ipify.org?format=json');
        const data = await response.json();
        // document.getElementById('ip').innerText = `Your IP Address: ${data.ip}`;
        // console.log("IP: " + data.ip);
        localStorage.setItem("ip", data.ip);
        console.log("Registered: " + localStorage.getItem("ip"));
        ip = localStorage.getItem("ip");
        } 
    catch (error) {
        console.error('Error fetching IP address:', error);
    }
    return ip;
}

if (localStorage.getItem("ip") != "0.0.0.0" && localStorage.getItem("ip") != null) {
    console.log("Welcome back: " + localStorage.getItem("ip"));
    ip = localStorage.getItem("ip");
}else{
    getIP();
}

let expires = (new Date(Date.now()+ 300000000000000)).toUTCString();
document.cookie = "ip=" + localStorage.getItem("ip") + "; expires=" + expires +"; path=/"
