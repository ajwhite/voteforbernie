<?php
/*
 Template Name: Vote Information By State Page
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/

use VoteForBernie\Wordpress\Services\StateService;
use VoteForBernie\Wordpress\Helpers\VoteInfoHelper;
$stateService = new StateService();
$helper = new VoteInfoHelper();
$states = $stateService->getStates();
?>

<?php get_header(); ?>
			<div id="content" class="vote-info">
				<div class="wrap">
					<!-- <h2 class="m-all t-1of4 d-1of4">Did you know?</h2> -->
					<div class="m-all t-1of4 d-1of4 did-you-know">
						<h2>Did you know?</h2>
					</div>
					<div class="m-all t-3of4 d-3of4">
						<p>If your state doesn't have open primaries, you may be unable to vote for Bernie Sanders unless you are registered as a Democrat.</p>
						<!-- <p class="notice"><span>Dates may change at any time. Don't wait until the deadline!</span> <em>If you find any errors, please <a href="mailto:contact@voteforbernie.org">email</a>.</em></p> -->
<!-- 						<div class="bernie-book">
							<a href="http://www.amazon.com/gp/product/1568586841/ref=as_li_tl?ie=UTF8&amp;camp=1789&amp;creative=9325&amp;creativeASIN=1568586841&amp;linkCode=as2&amp;tag=voteforbernie-20&amp;linkId=4GDPARWACHB3OXXI"><img class="book-img" src="http://ws-na.amazon-adsystem.com/widgets/q?_encoding=UTF8&amp;ASIN=1568586841&amp;Format=_SL160_&amp;ID=AsinImage&amp;MarketPlace=US&amp;ServiceVersion=20070822&amp;WS=1&amp;tag=voteforbernie-20" alt=""></a>
							<p>Bernie Sander's book detailing his 8-hour-long filibuster in 2010.</p>
							<p class="disclaimer">All book proceeds go to charity, and buying from this link helps support this resource.</p>
							<img src="http://ir-na.amazon-adsystem.com/e/ir?t=voteforbernie-20&amp;l=as2&amp;o=1&amp;a=1568586841" width="1" height="1" border="0" alt="" />
						</div> -->
				</div>
				<!-- <div class="m-all t-3of4 d-3of4"> -->
				<div class="m-all t-all d-all">
					<!-- <h1 class="choose-state-header">Choose Your State</h1> -->
					<ul class="legend">
						<li class="open">Open Primaries</li>
						<li class="closed">Closed Primaries</li>
						<li class="other">Other</li>
						<li class="caucus">Caucus</li>
					</ul>
					<div id="vmap"></div>
				</div>

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">
									<!-- <h1 class="page-title"><?php the_title(); ?></h1> -->
									<div class="sign-up-notice">
										<p class="tentative">All dates are tentative and subject to change at any time.<br/>If you want to receive important updates for your state, sign up for the email list.</p>
										<?php //echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
										<p class="byline vcard">Last updated: <?php //the_modified_time(get_option('date_format')); ?>, if you find any mistakes, <a href="/contact/">contact us</a>.</p>
									</div>
								</header>

								<section class="entry-content cf" itemprop="articleBody">
									<div class="page-content m-all t-all d-all">
  									<div class="states">
  									<?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

									<?php foreach ($states as $state): ?>

									<div id="<?php echo $state->state; ?>"
												class="state <?php echo $state->state; ?> <?php echo $helper->getStatusClass($state); ?>">
										<h3><?php echo $state->getTitle(); ?></h3>
										<div class="state-info cf">
											<div class="m-all t-2of3 d-2of3">
												<p class="primaries">
													<?php echo $state->getTitle(); ?>
													has
													<strong class="status"><?php echo $state->status; ?></strong>
													<?php echo $state->type; ?>.
												</p>
												<p class="explain"><?php echo $helper->getExplanationText($state); ?></p>
												<p class="advice">
													<?php echo $state->denonym; ?> for Bernie:
													<a href="<?php echo $state->vote_link ?>"
														data-track="Vote Link, <?php echo $state->state; ?>"
														target="_blank"><?php echo $helper->getActionText($state); ?></a></p>
												<?php if ($state->under_18): ?>
													<p class="explain"><strong>Only 17?</strong> If you will be 18 by November 8, 2016, you can vote in the primaries!</p>
												<?php endif; ?>
												<?php if ($state->hasAdditionalNote()): ?>
													<p class="explain"><?php echo $state->additional_note; ?></p>
												<?php endif; ?>

												<?php if ($state->state === 'ny') {
													$today = time();
													$oct9 = mktime(0,0,0,10,9,2015);
													$daysLeft = round(($oct9 - $today)/86400);
													?>

													<div class="callout">
														<p>There are only <strong><?php echo $daysLeft ?> days left</strong> to update your registration to Democrat!<br/>
														If you miss the deadline, <strong>you will not be able to vote for Bernie!</strong>.</p>
														<p class="explain">Check your <a href="https://voterlookup.elections.state.ny.us/votersearch.aspx" data-track="Check Registration, <?php echo $stateCode; ?>" target="_blank">current registration status online</a><br/>
														If you are not already affiliated as a democrat, <a href="http://dmv.ny.gov/more-info/electronic-voter-registration-application" data-track="Online Register, <?php echo $stateCode; ?>" target="_blank">update your NY registration online</a>. <a href="http://www.ifyouwantbernie.com/NY/" target="_blank">more info</a></p>
													</div>
												<?php } ?>
											</div>
											<div class="resources m-all t-1of3 d-1of3">
												<p>
													<?php echo $state->getTypeText(); ?>:
													<strong><?php echo $state->getPrimaryDate(); ?></strong>
												</p>
												<p>
													Deadline:
													<?php if ($state->hasDeadlineDate()): ?>
														<time title="<?php echo $state->deadline_reference; ?>">
															<?php echo $state->deadline_date; ?>
														</time>
													<?php else: ?>
														<?php echo $state->deadline_reference; ?>
													<?php endif; ?>
												</p>
												<ul>
													<li>Discussion: <?php echo $state->discussion_link; ?></li>
													<!-- <li><a href="<?php echo $state->check_registration_link; ?>" data-track="Check Registration, <?php echo $state->state; ?>">Check your current registration</a></li> -->
												</ul>
											</div>
										</div>
									</div>
									<?php endforeach; ?>

                  <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
                  </div>

										<?php // the_content(); ?>
									</div>
								</section>

								<?php // comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

						<?php // get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
