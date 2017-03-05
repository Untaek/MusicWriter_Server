
	$(function(){
		$('#sort_btn a').on('click', function(){
			$('#sort_btn a').removeClass('active');
			$(this).addClass("active");
		});
		var category = "#<?php echo basename($_SERVER['PHP_SELF']) ?>";
		category = category.substring(0, category.length-4);
		console.log(category);
		$(category).addClass("active");
		$(category).addClass("btn-primary");
		$("#<?php echo $_GET['sort'] ?>").addClass("active");
	});
