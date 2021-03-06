<?php
if (!defined('IN_TEMPLATE')) {
    exit('Access denied');
}
?>
<script>
	var old = 'dashboard';
    if(location.hash!='#')old = location.hash.substr(1);
    var cont_sub_url = "<?=$SkyOJ->uri('contest','view',$tmpl['contest']->cont_id(),'subpage')?>/";
	$(document).ready(function(){
	    $( "[navpage]" ).click(function(){loadTemplate($(this).attr('navpage'));});
        $("[navpage='"+old+"']").addClass('active');
        loadTemplate(old);
	});

	function loadTemplate(template){
        $("[navpage='"+old+"']").removeClass();
        $("[navpage='"+template+"']").addClass('active');
        old = template;
        loadTemplateToBlock(template,'main-page');
        
        return ;
	}
	function loadTemplateToBlock( template , bid  ){
	    var content = document.getElementById(bid);
	    if( content === null )return false;

        adder = '?';
        if( adder.indexOf('?') != -1 )
        {
            adder = '&';
        }
	    $(content).load(cont_sub_url+template,function(){
            MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
            $(content).hide();
            $(content).fadeIn();
            $('#'+bid+' a[tmpl]').click(function(event){
                event.preventDefault();
                tmpl = $(this).attr('tmpl');
                console.log(tmpl);
                console.log(bid);
                loadTemplateToBlock(tmpl,bid);
            });
            //fix img url
             var patten = /^https?:\/\//i;
            $("#main-page img").each(function(){
                var src = this.getAttribute('src');
                if( !patten.test(src) ){
                    src = cont_sub_url + template +'/' + src;
                    this.setAttribute('src',src);
                }
            });
        });
	}
    //$('.dropdown-toggle').dropdown();
</script>
<div class="container">
    <div class="row">
        <div class="col-sm-2 col-md-2" style="min-height:500px">
            <div>
                <h3><?=\SKYOJ\html($tmpl['contest']->title)?></h3>
                <p>剩餘時間 : <span data-toggle="sky-countdown" data-value="<?=$tmpl['contest']->endtime?>" onclockdownzero="location.reload()"></span></p>
            </div>
            <hr>
            <ul class="nav nav-pills nav-stacked">
                <?php foreach($tmpl['contest']->get_user_problems_info($_G['uid']) as $prob):?>
                    <li role="presentation" navpage='prob_<?=\SKYOJ\html($prob->ptag)?>'><a href="#prob_<?=\SKYOJ\html($prob->ptag)?>"><?=\SKYOJ\html($prob->ptag.', '.\SKYOJ\Problem::get_title($prob->pid))?></a></li>
                <?php endforeach;?>
                <li role="presentation" navpage='submit'><a href="#submit">上傳</a></li>
                <li role="presentation" navpage='log'><a href="#log">上傳紀錄</a></li>
                <li role="presentation" navpage='scoreboard'><a href="#scoreboard">記分板</a></li>
            </ul>
        </div>
        <div class="col-sm-10 col-md-10" id="main-page"></div>
    </div>
</div>
