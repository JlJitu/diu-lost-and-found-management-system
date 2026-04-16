function toggleChat(){
let c=document.getElementById("chatbox");
c.style.display=(c.style.display=="block")?"none":"block";
}

function sendMsg(){
let input=document.getElementById("userInput").value.toLowerCase();
let box=document.getElementById("messages");

box.innerHTML+="<p>You: "+input+"</p>";

let reply="Try lost / found";

if(input.includes("lost")) reply="Click Add Item → Lost";
else if(input.includes("found")) reply="Click Add Item → Found";
else if(input.includes("claim")) reply="Click Got It";

box.innerHTML+="<p>Bot: "+reply+"</p>";

document.getElementById("userInput").value="";
}