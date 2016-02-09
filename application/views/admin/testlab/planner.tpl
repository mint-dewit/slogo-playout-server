{extends "../layout.tpl"}

{block "header"}

<script src='http://lestor.nl/js/autosize-master/jquery.autosize.js'></script>
<script src='https://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>

<script>

$(document).ready(function() {
    var taskWidth = $('.canvas').width() * 0.1428;
    
    activate('.task', taskWidth)
    
    $(".day").droppable( {
        hoverClass: "active",
        accept: '.task',
        drop: handleDrop,
        tolerance: 'pointer',
    });
    
    $('.task textarea').autosize();
    
    function handleDrop(event,ui) {
        var dropTarget = $(this).data('weekday');
        ui.draggable.css('left', '0');
        ui.draggable.appendTo('.' + dropTarget);
    };
    
    $(document).on("click", "#add-60min", function(e) {
        e.preventDefault();
        var top = 0;//$(this).parent().data('index')  * 40;
        $('.monday').prepend('<div class="task new-task" style="top: '+top+'px;"><a href="#" class="delete"><img src="http://lestor.nl/beheer/img/iconen/prullenbak.png" /></a><input type="text" value="Nieuwe afspraak" /></div>');
        activate('.new-task', taskWidth);
        $('.new-task').removeClass('new-task');
    });

    $(document).on("click", "#add-30min", function(e) {
        e.preventDefault();
        var top = 0;//$(this).parent().data('index')  * 40;
        $('.monday').prepend('<div class="task new-task" style="top: '+top+'px; height:30px;"><a href="#" class="delete"><img src="http://lestor.nl/beheer/img/iconen/prullenbak.png" /></a><input type="text" value="Nieuwe afspraak" /></div>');
        activate('.new-task', taskWidth);
        $('.new-task').removeClass('new-task');
    });

    $(document).on("click", "#add-10min", function(e) {
        e.preventDefault();
        var top = 0;//$(this).parent().data('index')  * 40;
        $('.monday').prepend('<div class="task new-task" style="top: '+top+'px; height:10px;"><a href="#" class="delete"><img src="http://lestor.nl/beheer/img/iconen/prullenbak.png" /></a><input type="text" value="Nieuwe afspraak" /></div>');
        activate('.new-task', taskWidth);
        $('.new-task').removeClass('new-task');
    });
    
    $(document).on("click", ".task .delete", function(e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    $('.programme-select').change(function(){
        var id = $(this).children('option:selected').attr('value');
        $('.episode-selector').css({literal}{'display':'none'}{/literal});
        $('.episode-selector#' + id).css({literal}{'display':'inline-block'}{/literal});
    });

    $(document).on("click", ".episode-select", function(e) {
        var top = 0;
        var height = $(this).attr('dur');
        var title = $('.programme-select').children('option:selected').html() + ': ' + $(this).html();
        $('.monday').prepend('<div class="task new-task" style="top: '+top+'px; height:'+height+'px; background-color:'+$(this).attr('color')+'"><a href="#" class="delete"><img src="http://lestor.nl/beheer/img/iconen/prullenbak.png" /></a><span>'+title+'</span></div>');
        activate('.new-task', taskWidth);
        $('.new-task').removeClass('new-task');
    });
    
});

function activate( element, taskWidth ) {
        $( element ).draggable({ 
        //grid: [ taskWidth, 30 ],
        containment: ".canvas",
        zIndex: 50,
        opacity: 0.7,
        stack: ".canvas",
        snap: '.task,.hour',
        snapMode: "outer",
        snapTolerance: 2
    })
    .resizable({
        grid: 20,
        maxWidth: taskWidth,
        minHeight: 20,
        handles: 'n, s',
        containment: ".canvas"
    });
};

</script>

<style>

#week ul li, #week .grid *, #week .canvas * {
    box-sizing: border-box;
}

#week {
    position: relative;
    width: 100%;
}

#week ul, #week ul li {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
    font-size: 12px;
}

#week .days {
    position: absolute;
    top: 0px;
    left: 50px;
    right: 0px;
    height: 30px;
    line-height: 30px;
    font-weight: bold;
    color: #6b7092;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    background: #14183e;
}

#week .days li {
    float: left;
    padding-left: 10px;
    width: 14.28%;
}

#week .hours {
    position: absolute;
    top: 12px;
    left: 0px;
}

#week .hours li {
    height: 60px;
    line-height: 60px;
}

#week .canvas {
    position: absolute;
    top: 32px;
    left: 50px;
    right: 0px;
    height: 1440px;
    border-radius: 3px;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    background : #fff;
}

#week .canvas .day {
    float: left;
    width: 14.28%;
    height: 100%;
    border-left: 2px solid #f0f0f0;
}

#week .canvas .active {
    background: #edf8ff;
}

#week .canvas .day:nth-child(1) {
    border-left: 0px;
}

#week .canvas .day .hour {
    float: left;
    width: 100%;
    height: 60px;
    border-top: 2px dotted #f0f0f0;
}

#week .canvas .day .hour a {
    display: block;
    width: 100%;
    height: 100%;
}

#week .canvas .day {
    position: relative;
}

#week .canvas .day .grid .hour:nth-child(1) {
    border-top: 0px;
}

#week .canvas .day .task {
    position: absolute;
    z-index: 50;
    padding: 0px 10px;
    width: 100%;
    height: 60px;
    line-height: 20px;
    cursor: move;
    border-radius: 3px;
    background: #d6f0ff;
    font-size: 12px;
}

#week .canvas .day .task .delete {
    position: absolute;
    top: 2px;
    right: 10px;
    display: none;
    z-index: 10;
}
#week .canvas .day .task span {
    display: none;
    z-index: 10;

}


#week .canvas .day .task:hover .delete {
    display: block;
}
#week .canvas .day .task:hover span {
    display: block;
}

.episode-selector {
    display: none;
}
</style>

{/block}

{block "content"}
<a href="#" id="add-10min">Item 10 minuten </a><a href="#" id="add-30min">Item 30 minuten </a><a href="#" id="add-60min">Item 60 minuten </a>

<div id="add">
    <select multiple class="programme-select">
      <option value="1" selected="selected">De Huiskamer</option>
      <option value="2">Actuele items</option>
      <option value="3">Roadmovies</option>
      <option value="4">Reclames</option>
    </select>
    <select multiple class="episode-selector" id="1" style="display:inline-block;">
      <option value="1" dur="23" color="#AA74F0" class="episode-select">Aflevering 1</option>
      <option value="2" dur="19" color="#AA74F0" class="episode-select">Afl 2</option>
      <option value="3" dur="32" color="#AA74F0" class="episode-select">Afl 3</option>
      <option value="4" dur="22" color="#AA74F0" class="episode-select">Afl 4</option>
    </select>
    <select multiple class="episode-selector" id="2">
      <option value="1" dur="52" color="#BF0000" class="episode-select">week1</option>
      <option value="2" dur="59" color="#BF0000" class="episode-select">week 2</option>
      <option value="3" dur="78" color="#BF0000" class="episode-select">week 3</option>
      <option value="4" dur="47" color="#BF0000" class="episode-select">week 4</option>
    </select>
    <select multiple class="episode-selector" id="3">
      <option value="1" dur="7" color="#AA74F0" class="episode-select">Aflevering 1</option>
      <option value="2" dur="7" color="#AA74F0" class="episode-select">Afl 2</option>
      <option value="3" dur="7" color="#AA74F0" class="episode-select">Afl 3</option>
      <option value="4" dur="7" color="#AA74F0" class="episode-select">Afl 4</option>
    </select>
    <select multiple class="episode-selector" id="4">
      <option value="1" dur="1" color="#74F0EE" class="episode-select">1 minuut</option>
      <option value="2" dur="7" color="#74F0EE" class="episode-select">mede mogelijk gemaakt door</option>
      <option value="3" dur="12" color="#74F0EE" class="episode-select">lang</option>
      <option value="4" dur="4" color="#74F0EE" class="episode-select">kort</option>
    </select>
</div>

<div id="week">
    <ul class="days">
        <li>Ma</li>
        <li>Di</li>
        <li>Wo</li>
        <li>Do</li>
        <li>Vr</li>
        <li>Za</li>
        <li>Zo</li>
    </ul>
    <ul class="hours">
        <li>00:00</li>
        <li>01:00</li>
        <li>02:00</li>
        <li>03:00</li>
        <li>04:00</li>
        <li>05:00</li>
        <li>06:00</li>
        <li>07:00</li>
        <li>08:00</li>
        <li>09:00</li>
        <li>10:00</li>
        <li>11:00</li>
        <li>12:00</li>
        <li>13:00</li>
        <li>14:00</li>
        <li>15:00</li>
        <li>16:00</li>
        <li>17:00</li>
        <li>18:00</li>
        <li>19:00</li>
        <li>20:00</li>
        <li>21:00</li>
        <li>22:00</li>
        <li>23:00</li>
    </ul>
    <div class="canvas">
        <div class="day monday" data-weekday="monday">
            <div class="grid">
                <div class="hour" data-index="0"><a href="#"></a></div>
                <div class="hour" data-index="1"><a href="#"></a></div>
                <div class="hour" data-index="2"><a href="#"></a></div>
                <div class="hour" data-index="3"><a href="#"></a></div>
                <div class="hour" data-index="4"><a href="#"></a></div>
                <div class="hour" data-index="5"><a href="#"></a></div>
                <div class="hour" data-index="6"><a href="#"></a></div>
                <div class="hour" data-index="7"><a href="#"></a></div>
                <div class="hour" data-index="8"><a href="#"></a></div>
                <div class="hour" data-index="9"><a href="#"></a></div>
                <div class="hour" data-index="10"><a href="#"></a></div>
                <div class="hour" data-index="11"><a href="#"></a></div>
                <div class="hour" data-index="12"><a href="#"></a></div>
                <div class="hour" data-index="13"><a href="#"></a></div>
                <div class="hour" data-index="14"><a href="#"></a></div>
                <div class="hour" data-index="15"><a href="#"></a></div>
                <div class="hour" data-index="16"><a href="#"></a></div>
                <div class="hour" data-index="17"><a href="#"></a></div>
                <div class="hour" data-index="18"><a href="#"></a></div>
                <div class="hour" data-index="19"><a href="#"></a></div>
                <div class="hour" data-index="20"><a href="#"></a></div>
                <div class="hour" data-index="21"><a href="#"></a></div>
                <div class="hour" data-index="22"><a href="#"></a></div>
                <div class="hour" data-index="23"><a href="#"></a></div>
            </div>
        </div>
        <div class="day tuesday" data-weekday="tuesday">
            <div class="grid">
                <div class="hour" data-index="0"><a href="#"></a></div>
                <div class="hour" data-index="1"><a href="#"></a></div>
                <div class="hour" data-index="2"><a href="#"></a></div>
                <div class="hour" data-index="3"><a href="#"></a></div>
                <div class="hour" data-index="4"><a href="#"></a></div>
                <div class="hour" data-index="5"><a href="#"></a></div>
                <div class="hour" data-index="6"><a href="#"></a></div>
                <div class="hour" data-index="7"><a href="#"></a></div>
                <div class="hour" data-index="8"><a href="#"></a></div>
                <div class="hour" data-index="9"><a href="#"></a></div>
                <div class="hour" data-index="10"><a href="#"></a></div>
                <div class="hour" data-index="11"><a href="#"></a></div>
                <div class="hour" data-index="12"><a href="#"></a></div>
                <div class="hour" data-index="13"><a href="#"></a></div>
                <div class="hour" data-index="14"><a href="#"></a></div>
                <div class="hour" data-index="15"><a href="#"></a></div>
                <div class="hour" data-index="16"><a href="#"></a></div>
                <div class="hour" data-index="17"><a href="#"></a></div>
                <div class="hour" data-index="18"><a href="#"></a></div>
                <div class="hour" data-index="19"><a href="#"></a></div>
                <div class="hour" data-index="20"><a href="#"></a></div>
                <div class="hour" data-index="21"><a href="#"></a></div>
                <div class="hour" data-index="22"><a href="#"></a></div>
                <div class="hour" data-index="23"><a href="#"></a></div>
            </div>
        </div>
        <div class="day wednesday" data-weekday="wednesday">
            <div class="grid">
                <div class="hour" data-index="0"><a href="#"></a></div>
                <div class="hour" data-index="1"><a href="#"></a></div>
                <div class="hour" data-index="2"><a href="#"></a></div>
                <div class="hour" data-index="3"><a href="#"></a></div>
                <div class="hour" data-index="4"><a href="#"></a></div>
                <div class="hour" data-index="5"><a href="#"></a></div>
                <div class="hour" data-index="6"><a href="#"></a></div>
                <div class="hour" data-index="7"><a href="#"></a></div>
                <div class="hour" data-index="8"><a href="#"></a></div>
                <div class="hour" data-index="9"><a href="#"></a></div>
                <div class="hour" data-index="10"><a href="#"></a></div>
                <div class="hour" data-index="11"><a href="#"></a></div>
                <div class="hour" data-index="12"><a href="#"></a></div>
                <div class="hour" data-index="13"><a href="#"></a></div>
                <div class="hour" data-index="14"><a href="#"></a></div>
                <div class="hour" data-index="15"><a href="#"></a></div>
                <div class="hour" data-index="16"><a href="#"></a></div>
                <div class="hour" data-index="17"><a href="#"></a></div>
                <div class="hour" data-index="18"><a href="#"></a></div>
                <div class="hour" data-index="19"><a href="#"></a></div>
                <div class="hour" data-index="20"><a href="#"></a></div>
                <div class="hour" data-index="21"><a href="#"></a></div>
                <div class="hour" data-index="22"><a href="#"></a></div>
                <div class="hour" data-index="23"><a href="#"></a></div>
            </div>
        </div>
        <div class="day thursday" data-weekday="thursday">
            <div class="grid">
                <div class="hour" data-index="0"><a href="#"></a></div>
                <div class="hour" data-index="1"><a href="#"></a></div>
                <div class="hour" data-index="2"><a href="#"></a></div>
                <div class="hour" data-index="3"><a href="#"></a></div>
                <div class="hour" data-index="4"><a href="#"></a></div>
                <div class="hour" data-index="5"><a href="#"></a></div>
                <div class="hour" data-index="6"><a href="#"></a></div>
                <div class="hour" data-index="7"><a href="#"></a></div>
                <div class="hour" data-index="8"><a href="#"></a></div>
                <div class="hour" data-index="9"><a href="#"></a></div>
                <div class="hour" data-index="10"><a href="#"></a></div>
                <div class="hour" data-index="11"><a href="#"></a></div>
                <div class="hour" data-index="12"><a href="#"></a></div>
                <div class="hour" data-index="13"><a href="#"></a></div>
                <div class="hour" data-index="14"><a href="#"></a></div>
                <div class="hour" data-index="15"><a href="#"></a></div>
                <div class="hour" data-index="16"><a href="#"></a></div>
                <div class="hour" data-index="17"><a href="#"></a></div>
                <div class="hour" data-index="18"><a href="#"></a></div>
                <div class="hour" data-index="19"><a href="#"></a></div>
                <div class="hour" data-index="20"><a href="#"></a></div>
                <div class="hour" data-index="21"><a href="#"></a></div>
                <div class="hour" data-index="22"><a href="#"></a></div>
                <div class="hour" data-index="23"><a href="#"></a></div>
            </div>
        </div>
        <div class="day friday" data-weekday="friday">
            <div class="grid">
                <div class="hour" data-index="0"><a href="#"></a></div>
                <div class="hour" data-index="1"><a href="#"></a></div>
                <div class="hour" data-index="2"><a href="#"></a></div>
                <div class="hour" data-index="3"><a href="#"></a></div>
                <div class="hour" data-index="4"><a href="#"></a></div>
                <div class="hour" data-index="5"><a href="#"></a></div>
                <div class="hour" data-index="6"><a href="#"></a></div>
                <div class="hour" data-index="7"><a href="#"></a></div>
                <div class="hour" data-index="8"><a href="#"></a></div>
                <div class="hour" data-index="9"><a href="#"></a></div>
                <div class="hour" data-index="10"><a href="#"></a></div>
                <div class="hour" data-index="11"><a href="#"></a></div>
                <div class="hour" data-index="12"><a href="#"></a></div>
                <div class="hour" data-index="13"><a href="#"></a></div>
                <div class="hour" data-index="14"><a href="#"></a></div>
                <div class="hour" data-index="15"><a href="#"></a></div>
                <div class="hour" data-index="16"><a href="#"></a></div>
                <div class="hour" data-index="17"><a href="#"></a></div>
                <div class="hour" data-index="18"><a href="#"></a></div>
                <div class="hour" data-index="19"><a href="#"></a></div>
                <div class="hour" data-index="20"><a href="#"></a></div>
                <div class="hour" data-index="21"><a href="#"></a></div>
                <div class="hour" data-index="22"><a href="#"></a></div>
                <div class="hour" data-index="23"><a href="#"></a></div>
            </div>
        </div>
        <div class="day weekend-day saturday" data-weekday="saturday">
            <div class="grid">
                <div class="hour" data-index="0"><a href="#"></a></div>
                <div class="hour" data-index="1"><a href="#"></a></div>
                <div class="hour" data-index="2"><a href="#"></a></div>
                <div class="hour" data-index="3"><a href="#"></a></div>
                <div class="hour" data-index="4"><a href="#"></a></div>
                <div class="hour" data-index="5"><a href="#"></a></div>
                <div class="hour" data-index="6"><a href="#"></a></div>
                <div class="hour" data-index="7"><a href="#"></a></div>
                <div class="hour" data-index="8"><a href="#"></a></div>
                <div class="hour" data-index="9"><a href="#"></a></div>
                <div class="hour" data-index="10"><a href="#"></a></div>
                <div class="hour" data-index="11"><a href="#"></a></div>
                <div class="hour" data-index="12"><a href="#"></a></div>
                <div class="hour" data-index="13"><a href="#"></a></div>
                <div class="hour" data-index="14"><a href="#"></a></div>
                <div class="hour" data-index="15"><a href="#"></a></div>
                <div class="hour" data-index="16"><a href="#"></a></div>
                <div class="hour" data-index="17"><a href="#"></a></div>
                <div class="hour" data-index="18"><a href="#"></a></div>
                <div class="hour" data-index="19"><a href="#"></a></div>
                <div class="hour" data-index="20"><a href="#"></a></div>
                <div class="hour" data-index="21"><a href="#"></a></div>
                <div class="hour" data-index="22"><a href="#"></a></div>
                <div class="hour" data-index="23"><a href="#"></a></div>
            </div>
        </div>
        <div class="day weekend-day sunday" data-weekday="sunday">
            <div class="grid">
                <div class="hour" data-index="0"><a href="#"></a></div>
                <div class="hour" data-index="1"><a href="#"></a></div>
                <div class="hour" data-index="2"><a href="#"></a></div>
                <div class="hour" data-index="3"><a href="#"></a></div>
                <div class="hour" data-index="4"><a href="#"></a></div>
                <div class="hour" data-index="5"><a href="#"></a></div>
                <div class="hour" data-index="6"><a href="#"></a></div>
                <div class="hour" data-index="7"><a href="#"></a></div>
                <div class="hour" data-index="8"><a href="#"></a></div>
                <div class="hour" data-index="9"><a href="#"></a></div>
                <div class="hour" data-index="10"><a href="#"></a></div>
                <div class="hour" data-index="11"><a href="#"></a></div>
                <div class="hour" data-index="12"><a href="#"></a></div>
                <div class="hour" data-index="13"><a href="#"></a></div>
                <div class="hour" data-index="14"><a href="#"></a></div>
                <div class="hour" data-index="15"><a href="#"></a></div>
                <div class="hour" data-index="16"><a href="#"></a></div>
                <div class="hour" data-index="17"><a href="#"></a></div>
                <div class="hour" data-index="18"><a href="#"></a></div>
                <div class="hour" data-index="19"><a href="#"></a></div>
                <div class="hour" data-index="20"><a href="#"></a></div>
                <div class="hour" data-index="21"><a href="#"></a></div>
                <div class="hour" data-index="22"><a href="#"></a></div>
                <div class="hour" data-index="23"><a href="#"></a></div>
            </div>
        </div>
    </div>
</div>

{/block}