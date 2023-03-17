<script>

let thumbs = document.querySelectorAll(".thumb img");
let large = document.querySelector(".large img");
let largeCaption = document.querySelector(".caption span");

for(let thumb of thumbs){
	thumb.onclick = function(){
		large.src = this.src;
		largeCaption.innerHTML = this.alt;

		for(item of thumbs){
			item.classList.remove("selected");
		}

		this.classList.add("selected");
	}
}

</script>