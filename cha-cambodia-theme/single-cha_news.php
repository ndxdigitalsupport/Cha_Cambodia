<?php get_header(); ?>

    <!-- ===== SINGLE NEWS ARTICLE ===== -->
    <section class="section" id="news-single" style="padding-top: 120px;">
      <div class="container" style="max-width: 800px;">
        <!-- Back Link -->
        <div style="margin-bottom: 24px;" data-reveal>
          <a href="<?php echo esc_url(get_post_type_archive_link('cha_news')); ?>" class="card-link" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.9375rem;">
            <span class="arrow" style="transform: rotate(180deg);">&rarr;</span> <?php esc_html_e('Back to News', 'cha-cambodia'); ?>
          </a>
        </div>

        <?php while (have_posts()) : the_post();
            $date_display = get_post_meta(get_the_ID(), '_cha_news_date', true);
            $badge = get_post_meta(get_the_ID(), '_cha_news_badge', true);
            if (!$date_display) $date_display = get_the_date('M j, Y');
            if (!$badge) $badge = 'Event';
            $badge_class = 'badge-' . strtolower($badge);
            ?>
            <article data-reveal>
              <!-- Featured Image -->
              <?php if (has_post_thumbnail()) : ?>
                <div style="border-radius: 12px; overflow: hidden; margin-bottom: 32px; aspect-ratio: 16/9;">
                  <?php the_post_thumbnail('large', array('style' => 'width:100%;height:100%;object-fit:cover;')); ?>
                </div>
              <?php endif; ?>

              <!-- Meta -->
              <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <span class="badge <?php echo esc_attr($badge_class); ?>" style="font-size: 0.8125rem;"><?php echo esc_html($badge); ?></span>
                <span style="color: var(--c-muted); font-size: 0.9375rem;"><?php echo esc_html($date_display); ?></span>
              </div>

              <!-- Title -->
              <h1 style="font-size: 2rem; font-weight: var(--fw-bold); color: var(--c-blue); margin-bottom: 32px; line-height: 1.3;">
                <?php the_title(); ?>
              </h1>

              <!-- Content -->
              <div class="news-content" style="font-size: 1.0625rem; line-height: 1.8; color: var(--c-dark);">
                <?php the_content(); ?>
              </div>
            </article>
        <?php endwhile; ?>
      </div>
    </section>

<?php get_footer(); ?>
