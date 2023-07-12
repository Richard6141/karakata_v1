
    <script src="{{ asset('js/scripts/app-invoice.js') }}"></script>
    <script>
  checked = 0;
  checkers = document.querySelectorAll('#checkme'); 
  button = document.getElementById('assignbutton'); 
  for (let i = 0; i < checkers.length; i++) {
    checkers[i].addEventListener("click", function() {
        if (checkers[i].checked) {
            checked++;
        } else {
            checked--;;
        }
        if(checked>0){
            button.disabled = false;
            document.getElementById('selectform').style.display = "block";
            document.getElementById('assignation').style.display = "block";
        }else{
            button.disabled = true;
            document.getElementById('selectform').style.display = "none";
            document.getElementById('assignation').style.display = "none";
        }
    });
  }
</script>