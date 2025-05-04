<script src="../assets/js/jquery.js"></script>
<!-- <script src="../assets/js/datatables.min.js"></script> -->

<script >
		const currentLocation = location.href;
		const menuItem = document.querySelectorAll(".item-list");
		const menuLenght = menuItem.length
		for (let i = 0; i < menuLenght; i++) {
			if (menuItem[i].href === currentLocation) {			
        console.log('url:', menuItem[i].href === currentLocation)	
				menuItem[i].classList.add("active");
			}
		}		
	</script>