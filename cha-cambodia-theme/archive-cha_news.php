<?php get_header(); ?>

    <!-- ===== NEWS & EVENTS ARCHIVE ===== -->
    <section class="section news-archive-section" id="news-archive">
      <div class="container">
        <div class="section-heading text-left" data-reveal>
          <h1 data-i18n="news_archive_heading"><?php esc_html_e('News & Events', 'cha-cambodia'); ?></h1>
          <p data-i18n="news_archive_sub"><?php esc_html_e('Stay updated with the latest from the Cambodian Haemophilia Association.', 'cha-cambodia'); ?></p>
        </div>

        <!-- Category Filter -->
        <div class="tc-toolbar" data-reveal>
          <div class="tc-toolbar-filter">
            <a href="<?php echo esc_url(get_post_type_archive_link('cha_news')); ?>"
               class="btn btn-sm <?php echo (!is_tax('news_category') && !isset($_GET['cat'])) ? 'btn-dark' : 'btn-outline'; ?>" data-i18n="news_filter_all"><?php esc_html_e('All', 'cha-cambodia'); ?></a>
            <?php
            $badge_types = array('Event', 'Update', 'Workshop', 'Announcement');
            foreach ($badge_types as $b) :
                $current = (isset($_GET['cat']) && $_GET['cat'] === strtolower($b));
                $filter_key = 'news_filter_' . strtolower($b);
                ?>
                <a href="<?php echo esc_url(add_query_arg('cat', strtolower($b), get_post_type_archive_link('cha_news'))); ?>"
                   class="btn btn-sm <?php echo $current ? 'btn-dark' : 'btn-outline'; ?>" data-i18n="<?php echo esc_attr($filter_key); ?>"><?php echo esc_html($b); ?></a>
            <?php endforeach; ?>
          </div>
        </div>

        <?php
        $is_event_filter = (isset($_GET['cat']) && strtolower(sanitize_text_field($_GET['cat'])) === 'event');
        ?>

        <?php if ($is_event_filter) : ?>
          <!-- Upcoming Events Notice / Coming Soon Banner -->
          <div class="events-notice-banner" data-reveal>
            <div class="events-notice-icon" aria-hidden="true">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <path d="M12 14v4"></path>
                <path d="M10 16h4"></path>
              </svg>
            </div>
            <div class="events-notice-content">
              <div class="events-notice-tag" data-i18n="events_status_coming_soon">
                <span class="events-pulse-dot"></span>
                Coming Soon
              </div>
              <h2 class="events-notice-title" data-i18n="events_notice_title">New Upcoming Events Coming Soon</h2>
              <p class="events-notice-desc" data-i18n="events_notice_desc">We are actively preparing our upcoming community awareness events, youth camps, and medical workshops. Stay tuned or become a member to receive official announcements directly!</p>
            </div>
            <div class="events-notice-action">
              <a href="#" class="btn btn-primary" data-member-trigger data-i18n="events_notice_btn">Get Notified</a>
            </div>
          </div>

          <div class="events-section-divider" data-reveal>
            <h3 class="events-past-heading" data-i18n="events_past_title">Past Events &amp; Highlights</h3>
            <span class="events-divider-line"></span>
          </div>
        <?php endif; ?>

        <!-- News Grid -->
        <div class="grid grid-3" style="margin-top: <?php echo $is_event_filter ? '24px' : '32px'; ?>;">
          <?php
          $args = array(
              'post_type'      => 'cha_news',
              'posts_per_page' => 10,
              'post_status'    => 'publish',
              'orderby'        => 'date',
              'order'          => 'DESC',
          );
          if (isset($_GET['cat']) && $_GET['cat']) {
              // Filter by badge meta value
              $args['meta_query'] = array(
                  array(
                      'key'     => '_cha_news_badge',
                      'value'   => sanitize_text_field($_GET['cat']),
                      'compare' => '=',
                  ),
              );
          }
          $news_query = new WP_Query($args);
          if ($news_query->have_posts()) :
              while ($news_query->have_posts()) : $news_query->the_post();
                  $date_display = get_post_meta(get_the_ID(), '_cha_news_date', true);
                  $badge = get_post_meta(get_the_ID(), '_cha_news_badge', true);
                  if (!$date_display) $date_display = get_the_date('M j, Y');
                  if (!$badge) $badge = 'Event';
                  $badge_class = 'badge-' . strtolower($badge);
                  ?>
                  <article class="card news-card" data-reveal>
                    <div class="card-img">
                      <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large'); ?>
                      <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/news-event-1.jpg'); ?>" alt="">
                      <?php endif; ?>
                      <div class="card-date">
                        <span><?php echo esc_html($date_display); ?></span>
                        <span class="badge <?php echo esc_attr($badge_class); ?> auto-text" data-en="<?php echo esc_attr($badge); ?>" data-km="" data-i18n="news_badge_<?php echo esc_attr(strtolower($badge)); ?>"><?php echo esc_html($badge); ?></span>
                      </div>
                    </div>
                    <div class="card-body">
                      <?php
                      $news_title = get_the_title();
                      $news_km_title = get_post_meta(get_the_ID(), '_cha_news_title_km', true);
                      $news_excerpt = get_the_excerpt();
                      if (strlen($news_excerpt) > 120) $news_excerpt = wp_trim_words($news_excerpt, 18, '...');
                      $news_km_excerpt = get_post_meta(get_the_ID(), '_cha_news_excerpt_km', true);
                      ?>
                      <h3 class="card-title auto-text" data-en="<?php echo esc_attr($news_title); ?>" data-km="<?php echo esc_attr($news_km_title); ?>"><?php the_title(); ?></h3>
                      <p class="card-text auto-text" data-en="<?php echo esc_attr($news_excerpt); ?>" data-km="<?php echo esc_attr($news_km_excerpt); ?>"><?php echo esc_html($news_excerpt); ?></p>
                      <a class="card-link" href="<?php the_permalink(); ?>" data-i18n="news_read_more"><?php esc_html_e('Read More', 'cha-cambodia'); ?> <span class="arrow">&rarr;</span></a>
                    </div>
                  </article>
              <?php endwhile;
              wp_reset_postdata();
          else :
              ?>
              <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                <p style="font-size: 1.125rem; color: var(--c-muted);" data-i18n="news_no_articles"><?php esc_html_e('No articles found in this category.', 'cha-cambodia'); ?></p>
              </div>
          <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php
        $total_pages = $news_query->max_num_pages;
        if ($total_pages > 1) :
            $current_page = max(1, get_query_var('paged'));
            ?>
            <div style="text-align: center; margin-top: 40px; padding-bottom: 60px;" data-reveal>
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format'    => '?paged=%#%',
                        'current'   => $current_page,
                        'total'     => $total_pages,
                        'prev_text' => '&laquo; ' . __('Prev', 'cha-cambodia'),
                        'next_text' => __('Next', 'cha-cambodia') . ' &raquo;',
                    ));
                    ?>
                </div>
            </div>
        <?php endif; ?>
      </div>
    </section>

<?php get_footer(); ?>
