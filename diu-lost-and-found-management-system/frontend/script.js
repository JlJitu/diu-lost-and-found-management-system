function showSection(s){

document.getElementById('dashboard-section').style.display="none";
document.getElementById('lost-section').style.display="none";
document.getElementById('add-section').style.display="none";

document.getElementById(s+"-section").style.display="block";
}

window.onload=function(){
showSection('dashboard');
}