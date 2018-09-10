var itemImage=document.getElementsByClassName('item-image');
if (itemImage!==null)
{
	for (var i=0;i<itemImage.length;i++)
	{
		itemImage[i].addEventListener('mouseover',event=>{
			var itemDesc=document.getElementsByClassName('item-desc');
			itemDesc[i-1].children[0].style.display='block';
		});
		itemImage[i].addEventListener('mouseout',event=>{
			var itemDesc=document.getElementsByClassName('item-desc');
			itemDesc[i-1].children[0].style.display='none';
		});
	}
}
var forms=document.getElementsByClassName('item-desc');
if (forms!==null)
{
	//Prevents form submission
	for (var i=0;i<forms.length;i++)
	{
		forms[i].onsubmit=()=>false;
	}
	var buttons=document.getElementsByClassName('buy');
	for (var i=0;i<buttons.length;i++)
	{
		buttons[i].addEventListener('click',event=>{
			var values=[];
			for (var j=0;j<5;j++)
			{
				values.push(forms[i-1].elements['item'+j].value);
			}
			var chatbox=document.getElementById('chatbox');
			chatbox.style.display='block';
			document.getElementsByClassName('container')[0].style.opacity="0.2";
			var subject=document.getElementsByClassName('chat-subject')[0];
			document.getElementsByClassName('chat-body')[0].innerHTML="";
			subject.innerHTML=values;
			getChat(localStorage.sender,localStorage.receiver);
		});
	}
}
var chatMinimize=document.getElementById('chat-hide');
chatMinimize.addEventListener('click',event=>{
	var chatbox=document.getElementById('chatbox');
	chatbox.style.display='none';
	document.getElementsByClassName('container')[0].style.opacity="1";
});
var chatForm=document.getElementById('chat-form');
chatForm.onsubmit=()=>false;
var sendChatBtn=document.getElementById('chat-send');
sendChatBtn.addEventListener('click',event=>{
	if (chatForm.checkValidity()===true){
		var textarea=document.getElementById('chat-message')
		var message=textarea.value;
		var view=document.getElementsByClassName('chat-body')[0];
		view.innerHTML+='<div class="sender-message"><p>'+message+'</p></div>';
		chatForm.reset();
		textarea.focus();
		sendChat(localStorage.sender,localStorage.receiver,message);
	}
});
function sendChat(user,receiver,message)
{
	var request=new XMLHttpRequest();
	request.open("POST","chatprocessor.php",true);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	request.onreadystatechange=function(){
		if (this.readyState===4 && this.status===200){
			
		}
	}
	request.send("chatmessage=chat"+"&user="+user+"&receiver="+receiver+"&message="+message);
}
function getChat(sender,receiver){
	var request=new XMLHttpRequest();
	request.open("POST","chatprocessor.php",true);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	request.onreadystatechange=function(){
		if (this.readyState===4 && this.status===200){
			var body=document.getElementsByClassName('chat-body')[0];
			body.innerHTML=this.responseText;
		}
	}
	request.send("getchat=chat"+"&sender="+sender+"&receiver="+receiver);
}
function activeChat(){
	getChat(localStorage.sender,localStorage.receiver);
}
setInterval(activeChat,2000);