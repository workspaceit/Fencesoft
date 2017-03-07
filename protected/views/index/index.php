<!-- Dummy Selector and Filter Box -->
<div class="row">
	<div class="eight columns dummy-select">
		<?php echo $dummySelectContent; ?>
	</div>

	<div id="search-filter" class="four columns pretty widget-box">
		<h4 class="filter-header">Already Know What You Want?</h4>
		<form action="#" method="get" name="advence_search" id="advence_search">
			<input type="hidden" name="search_type" value="search_advance">
			<div class="widget-area-left">
				<p>
					<strong>Type of Fence</strong>
				</p>
				<ul>
					<li class="field">
					<?php if(!empty($fenceType)):
					foreach ($fenceType as $key=>$type):
					?>
					<label class="checkbox" for="<?php echo $key;?>">
						<input name="type[]" id="<?php echo $key;?>" value="<?php echo $key;?>" type="checkbox">
						<span></span> <?php echo $type;?>
					</label> 
					<?php endforeach;
					endif;
					?>
					</li>
				</ul>
			</div>
			<div class="widget-area-right">
				<p>
					<strong>Privacy Style</strong>
				</p>
				<ul>
					<li class="field">
						<label class="checkbox" for="full_privacy">
							<input name="privacy[]" value="Privacy" type="checkbox" id="full_privacy">
							<span></span> Full Privacy
						</label>
						<label class="checkbox" for="semi_private">
							<input name="privacy[]" value="Semi-Private" type="checkbox" id="semi_private">
							<span></span> Semi-Private
						</label>
						<label class="checkbox" for="pickets">
							<input name="privacy[]" type="checkbox" value="Picket" id="pickets">
							<span></span> Pickets
						</label>
					</li>
				</ul>
			</div>
			<div class="widget-area">
				<p>
					<strong>Fence Height (min/max)</strong>
					<div id="advance_height"></div>
					<input type="hidden" id="min_height" name="min_height" value="3" />
					<input type="hidden" id="max_height" name="max_height" value="7" />
				</p>
			</div>
			<div class="widget-area filter-search-btn">
				<p>Click below to filter the search results...</p>
				<div class="medium primary btn icon-right icon-search">
					<button type="submit">Filter Search<i class="icon-search"></i></button>
				</div>
			</div>
		</form>
	</div>
	<div class="clearfix">&nbsp;</div>
</div>

<!-- Tiled Materials -->
<div class="row">
	<div class="twelve columns" id="fence-data"></div>
</div>

<!-- Pagination -->
<div class="row">
	<div class="twelve columns" id="paginationHolder"></div>
</div>


<script type="text/javascript">
$(function(){
	function repositionTooltip( e, ui ){		
        $(ui.handle).attr("title",ui.value);
        $("#min_height").val(ui.values[0]);
        $("#max_height").val(ui.values[1]);
	}

	var getSearchData = function(postData){
		
		$.ajax({
			url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=index/getfences',
			data : postData,
			type : 'GET',
			success : function(data){
				$('#fence-data').html(data);
			}
		});
	};
	
	getSearchData($('form#advence_search').serializeArray());
	
	$('#search_fence').on('submit',function(e){
		e.preventDefault();
		
		postData = $(this).serializeArray();
		getSearchData(postData);
	});

	$('#advence_search').on('submit',function(e){
		e.preventDefault();
		
		postData = $(this).serializeArray();
		getSearchData(postData);
	});

	$( "#advance_height" ).slider({
		range: true,
		min: 2,
		max: 8,
		values: [3, 7],
		tooltip : 'show',
		//slide: function( event, ui ) {
			//$("#advance_height .ui-slider-handle:first").attr("title",$("#advance_height").slider( "values", 0 ));
			//$("#advance_height .ui-slider-handle:last").attr("title",$("#advance_height").slider( "values", 1 ));
		//}
		 slide: repositionTooltip, 
		 stop: repositionTooltip
	 });
	 
	$("#advance_height .ui-slider-handle:first").attr("title",$("#advance_height").slider( "values", 0 ));
	$("#advance_height .ui-slider-handle:last").attr("title",$("#advance_height").slider( "values", 1 ));
	$("#advance_height").tooltip({
		position: {
			my: "center top+15",
			at: "center bottom",
			using: function( position, feedback ) {
				$( this ).css( position );
				$( "<div>" )
				.addClass( "arrow top" )
				.addClass( feedback.vertical )
				.addClass( feedback.horizontal )
				.appendTo( this );
			}
		}
	 });

	$("select.image-picker").imagepicker({
	    hide_select : true,
	    show_label  : true,
    });

	$("select.image-picker").on('change',function(){		
		
		getSearchData($('form#dummy_selector_form').serializeArray());
		var selectedBlock = $(this).parents('.dummy-set-block');
		$('.dummy-set-block').addClass('hide');
		
		if($(this).val()=='Privacy'){
			 $('#'+selectedBlock.attr('data-next-tab-alt')).removeClass('hide');
		} else if($(this).val()=='WoodFences') {
			$('#'+selectedBlock.attr('data-next-tab-alt')).removeClass('hide');
			$('#dummy_selector_form')[0].reset();
		} else {
		    $('#'+selectedBlock.attr('data-next-tab')).removeClass('hide');
		    if(selectedBlock.attr('data-next-tab')=='dummy-set-1'){
		    	$('#dummy_selector_form')[0].reset();
			}
		}
		//$('#configform')[0].reset();
	});

	$('body').on('click','.click-sub-material',function(){		
		document.location.href = $(this).attr('href');
	});
});
</script>