<ul>
    <li>
        <span style="color: #00f; cursor: pointer;" id='first_tree_class' onclick="tree(this)">Тематические области</span>
        <ul style="display: none;" id='classificator_ul' >

        </ul>
    </li>
</ul>
<script>
var jQ = false;
function initJQ() {
  if (typeof(jQuery) == 'undefined') {
    if (!jQ) {
      jQ = true;
      document.write('<scr' + 'ipt type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></scr' + 'ipt>');
    }
    setTimeout('initJQ()', 50);
  } else {
    (function($) {
        $(function() {
            $('document').ready(ready());


        })
    })(jQuery)
  }
}
initJQ();

function ready(){

    
}

function tree(target) {
        var ul = target.parentNode.getElementsByTagName("ul").item(0);
        ul.style.display = (ul.style.display == "block") ? "none" : "block";
}

</script>