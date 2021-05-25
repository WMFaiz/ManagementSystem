<style>
* {
  box-sizing: border-box;
}

#text{
     font-family: Helvetica Neue;
	 font-style: normal;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

.desktop-container {
    max-width: 1440px;
    background-color: white;
    //height:auto;
    min-height: 600px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 10px;
    position: relative;
    margin: auto;
}

.background-container {
    max-width: 1440px;
    background-image: url("/app/img/MyIntern_bg.jpg");
    height: 780px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 10px;
    position: relative;
    margin: auto;
}

.background-content{
    max-width: 1440px;
    background-color: #f5f5f0;;
    height:auto;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 10px;
    position: relative;
    margin: auto;
}
.main {
    position:center;
    margin-top:140px;
}

.jumbotron{
    background-image: url("/app/img/MyIntern_Background_Photo_Grad@2x.png");
    height:300px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 10px;
    position: relative;
    margin: auto;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height:100%;
  /*min-height: 600px;*/
  background-color: #f5f5f0;
}

.container {
  padding: 20px;
}

.background-container .content{
  position: absolute;
  bottom: 65px;
  background: transparent;
  color: #f1f1f1;
  left:20px;
  padding-bottom:120px;
}

.background-container .content2 {
    position: relative;
    font-weight: bold;
    font-size: 18px;
    color: rgba(255,255,255,1);
    width:350px;
}

div.second {
    background-color: rgba(27,72,100,1);
    position: absolute;
    top: 50%;
    left: 50%; 
    transform: translate(-50%, -50%); 
    text-align:center; 
    width:350px;
    height:44px;
    border-radius:5px;
    opacity: 0.9;
}

div.third {
    background-color: rgba(3,30,75,1);
    position: absolute;
    top: 50%;
    left: 50%; 
    transform: translate(-50%, -50%); 
    text-align:center; 
    width:350px;
    height:44px;
    border-radius:5px;
    opacity: 0.9;
}

.btnSubmit {
    width: 45%;
    border-radius: 5px;
    padding:10px;
    border: none;
    background-color: rgba(40,137,136,1);
    color:white;
    font-family: Open Sans;
	font-style: normal;
	font-weight: bold;
	font-size: 14px;
}

.btnSubmitFacebook {
    width: 45%;
    border-radius: 5px;
    padding:10px;
    border: none;
    background-color: rgba(51,89,157,1);
    color:white;
    font-family: Open Sans;
	font-style: normal;
	font-weight: bold;
	font-size: 14px;
}

.btnSubmitGoogle {
    width: 45%;
    border-radius: 5px;
    padding:10px;
    border: none;
    background-color: rgba(41,132,252,1);
    color:white;
    font-family: Open Sans;
	font-style: normal;
	font-weight: bold;
	font-size: 14px;
}

#Email_or_username {
	text-align: left;
	font-family: Open Sans;
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	color: rgba(208,208,208,1);
	white-space: nowrap;
	width:45%;
	margin-left:28%;
}

button:hover {
  opacity: 0.8;
}

.select-box{
    width: 370px;
    position: relative; 
    margin-top: 18px;
}

.select-box select{
    height: 42px;
    padding: 10px 15px;
    line-height: 18px;
    font-size: 16px;
    width: 100%;
    border: 2px solid #7ebf21;
    border-radius: 20px;
    
    appearance: none;
}

.select-box:after{
    content:"";
    position: absolute;
    right: 20px;
    top:50%;
    margin-top: -4px;
    border-top: 8px solid #7ebf21;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    pointer-events: none;
}

.sidebar {
  height: 50%;
  width: 200px;
  position: absolute;
  z-index: 1;
  top: 5;
  left: 5;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 30px;
}

.sidebar a {
  padding: 25px 8px 10px 30px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar a.active {
  background-color: #7ebf21;
  color: white;
}

@media screen and (max-height: 900px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
    
.center {
  margin-top:100px;
}
}

</style>

