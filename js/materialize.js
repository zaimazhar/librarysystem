
document.addEventListener('DOMContentLoaded', function() {
  var elemsNav = document.querySelectorAll('.sidenav');
  var sidenav = M.Sidenav.init(elemsNav, {
      "edge": "right"
  });

  var elems1 = document.querySelectorAll('.collapsible');
  var collapsible = M.Collapsible.init(elems1);

  var elems2 = document.querySelector('#modal1') || document.querySelector('#modalLogin');
  var modal = M.Modal.init(elems2)
  var errorCheck = document.querySelector('#checkError') || window
  
  if(errorCheck.value == 'error') {
    var instance = M.Modal.getInstance(elems2)
    setTimeout(function() { instance.open() }, 1000)
  }
});