//Minute and Second Controls:
let btnIncMinute = document.getElementById("btnIncMinute");
let btnDecMinute = document.getElementById("btnDecMinute");

let btnIncHour = document.getElementById("btnIncHour");
let btnDecHour = document.getElementById("btnDecHour");

//Draw clock with size 300px x 300px:
var c = document.getElementById("clock");
var ctx = c.getContext("2d");
//Cricle at centre 150,150, radius 100, angle from 0 to 2PI.
ctx.beginPath();
ctx.arc(150, 150, 100, 0, 2 * Math.PI);
ctx.strokeStyle = "#000000";
ctx.lineWidth = 5;
ctx.stroke();//Draw
ctx.closePath();

//Draw numbers:
let angle = 0;
var xPos = 0;
var yPos = 0;

for (i = 1; i < 13; i++) {
    angle = (Math.PI * (i/6));
    xPos = Math.sin(angle) * 80;
    yPos = Math.cos(angle) * -80;
    ctx.font = "20px Arial";
    ctx.fillText(i, 145 + xPos, 155 + yPos);
    
}

ctx.beginPath();
ctx.moveTo(150, 150);
angle = (Math.PI * (1/6));
xPos = Math.sin(angle) * 85;
yPos = Math.cos(angle) * -85;
ctx.lineTo((xPos+145), (yPos+155));
ctx.strokeStyle = "#464646";
ctx.lineCap = "round";
ctx.lineWidth = 2;
ctx.stroke();
ctx.closePath();