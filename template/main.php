<style>

    
    #<?= $this->getUniqFirstIdUl();  ?>{
        <?= $this->getCss(); ?>
    }
</style>
<ul class="tree tree_ul_style">
    <li>
        <span style="color: #00a; cursor: pointer;" id=<?= $this->getUniqFirstId()?>><?= $this->getHeader()?></span>
        <ul style="display: none;" id=<?= $this->getUniqFirstIdUl('"');?> >

        </ul>
    </li>
</ul>

<script>
var jQ = false;
function initJQ() {
  if (typeof(jQuery) == 'undefined') {
    if (!jQ) {
      jQ = true;
      document.write('<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></scr' + 'ipt>');
    }
    setTimeout('initJQ()', 50);
  } else {
    (function($) {
        $(function() {
            $('.tree').ready(ready());
        })
    })(jQuery)
  }
}
initJQ();

//var tree = <?php echo(json_encode($this->tree));?>;

function ready(){
    var param = getGetTree();
    if (typeof param.dictionary == 'undefined'){
        return;
    }
    getTree(param.dictionary);
}

function tree(target) {
        var ul = target.parentNode.getElementsByTagName("ul").item(0);
        ul.style.display = (ul.style.display == "block") ? "none" : "block";
        
}

function getTree(id_st, elem, id ){
        if (typeof elem == 'undefined'){
            elem = 0;
        }
        var data = {};
        data.id_st = id_st;

        if (typeof id != 'undefined'){
            data.id = id;
        } else {
            data.id = 0;
        }

        $.ajax({
            url: <?= $this->getAjaxUrl() ?>, //'/home/get-tree-class',
            method: 'POST',
            dataType: 'json',
            type: 'POST',
            data: data,
            success: function(data) {
                addToTree(data, elem);
            },
            complete: function (){
                //$('i[id^="fa-"]').parent('li').hide();
            }
        })
    }
function getGetTree(){
    var params = window
        .location
        .search
        .replace('?','')
        .split('&')
        .reduce(
            function(p,e){
                if (empty(e)){
                    return 0;
                };
                var a = e.split('=');
                p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                return p;
            },
            {}
        );

    if (empty(params)) {
        return {};
    }

    return params;
}

var uniqFirstId = <?= $this->getUniqFirstId()?>;
var uniqFirstIdUl = <?= $this->getUniqFirstIdUl('"')?>;

function addToTree(data, elem){
        var param = getGet();
        var html = '';
        
        for (var d in data){
            if (param.theme_filter == data[d].name_cls){
                html += '<li data-id-cls="' + data[d].id_cls+ '" class="classificator back-gray">';
            } else {
                html += '<li data-id-cls="' + data[d].id_cls+ '" class="classificator">';
            }
            var elem_ = parseInt(elem) + 1;
            elem_ = uniqFirstIdUl.split('_')[0]+ '_' + elem_;

            if (data[d].cnt > 0){

                html += '<i class="fa fa-plus-square-o plus tree" data-count="' + data[d].cnt + '"  data-id-cls="' + data[d].id_cls+ '"  data-click='+ elem_ +'></i>';
                html += '<a class="left_5 plus-a" href="#"  data-count="' + data[d].cnt + '"  data-id-cls="' + data[d].id_cls+ '"  data-click='+ elem_ +'>' + data[d].name_cls + '</a>';
                html += '<ul id=' + elem_ + ' class="left_15 ul_tree"></ul></li>';
            } else {
                html += '<a class="plus-a" href="#" data-id-cls="' + data[d].id_cls+ '"  data-count="' + data[d].cnt + '"   data-click='+ elem_ +'>' + data[d].name_cls + '</a>';
                html += '</li>';
            }
        }

        if (data.length == 1) {
            if (data[0].cnt > 0){
                setTimeout(function(){
                    $('i.fa-plus-square-o.tree[data-id-cls="' + data[0].id_cls+'"]').trigger('click');
                },200);
            }
        }

        if (elem == 0 ) {
        $('#' + uniqFirstIdUl).show();
            $('#' + uniqFirstIdUl).html(html);
            $('#' + uniqFirstId).trigger('click');
        } else {
            $('#' + uniqFirstIdUl.split('_')[0] + '_' + elem).html(html);
        }
    }

    $('body').on('click', 'i.fa-plus-square-o.tree', function(){
        $(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
        var id_st = $('#dictionary').val();
        var elem = $(this).attr('data-click');
        elem = elem.split('_');
        elem = elem[1];
        var id = $(this).attr('data-id-cls');
        getTree(id_st, elem, id);
    });

    $('body').on('click', 'i.fa-minus-square-o.tree', function(){
        $(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
        var elem = $(this).attr('data-click');
        $('#'+elem).html('');
    });
</script>