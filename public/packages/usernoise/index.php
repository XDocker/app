<?php require(dirname(__FILE__) . "/common.php") ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="<?php echo usernoise_url('css/window.css?v=' . UN_VERSION) ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo usernoise_url('css/form.css?v=' . UN_VERSION) ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo usernoise_url('css/fixes.css?v=' . UN_VERSION) ?>" type="text/css">
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
	<script>var usernoise = {};</script>
	<script src="<?php echo (usernoise_url('js/usernoise.js?v=' . UN_VERSION)) ?>"></script>
	<script src="<?php echo (usernoise_url('js/window.js?v=' . UN_VERSION)) ?>"></script>
</head>
<body>
	<div id="window" class="helvetica-neue">
		<a id="window-close" href="#">Close</a>
		<div id="viewport" class="clearfix">
			<div id="un-feedback-wrapper">
				<div id="un-feedback-form-wrapper">
					<h2><?php echo $locale['form.feedback']?></h2>
					<form action="<?php echo usernoise_url('send.php') ?>" method="post" class="un-feedback-form" accept-charset="UTF-8">
						<?php if ($config['feedback.types.show']): ?>
							<div class="un-types-wrapper clearfix">
								<?php $h->link_to($locale['form.types.idea'], '#', array('class' => 'un-type-idea selected'))?>
								<?php $h->link_to($locale['form.types.problem'], '#', array('class' => 'un-type-problem'))?>
								<?php $h->link_to($locale['form.types.question'], '#', array('class' => 'un-type-question'))?>
								<?php $h->link_to($locale['form.types.praise'], '#', array('class' => 'un-type-praise'))?>
								<?php $h->hidden_field('type', 'idea')?>
							</div>
						<?php endif ?>
						<?php $h->textarea('description', $locale['form.description.placeholder'], array('id' => 'un-description', 'class' => 'text text-empty'))?>
						<?php if ($config['feedback.summary.show']): ?>
							<?php $h->text_field('title', $locale['form.summary.placeholder'], array('id' => 'un-title', 'class' => 'text text-empty'))?>
						<?php endif ?>
						<?php if ($config['feedback.email.show']): ?>
							<?php $h->text_field('email', $locale['form.email.placeholder'], array('id' => 'un-email', 'class' => 'text text-empty'))?>
						<?php endif ?>
						<input type="submit" class="un-submit" value="<?php echo htmlspecialchars($locale['form.submit.text']) ?>" id="un-feedback-submit">
						&nbsp;<img src="<?php echo usernoise_url('images/loader.gif') ?>" id="un-feedback-loader" class="loader" style="display: none;">
						<div class="un-feedback-errors-wrapper" style="display: none;">
							<div class="un-errors"></div>
						</div>
					</form>
				</div>
				<div id="un-thankyou" style="display: none;">
					<h2><?php echo $locale['form.thankyou.title'] ?></h2>
					<p><?php echo $locale['form.thankyou.text'] ?></p>
					<a href="#" id="un-feedback-close"><img src="<?php echo usernoise_url('images/ok.png')?>" id="thankyou-image"></a>
				</div>
			</div>
		</div>
	</div>
</body>