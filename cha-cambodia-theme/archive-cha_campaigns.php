<?php get_header(); ?>

    <!-- ===== CAMPAIGNS ARCHIVE ===== -->
    <section class="section" id="campaigns-archive" style="padding-top: 120px;">
      <div class="container">
        <div class="section-heading text-left" data-reveal>
          <h1 data-i18n="campaigns_archive_heading"><?php esc_html_e('Current Campaigns', 'cha-cambodia'); ?></h1>
          <p data-i18n="campaigns_archive_sub"><?php esc_html_e('Support our mission — every contribution changes lives across Cambodia.', 'cha-cambodia'); ?></p>
        </div>

        <div style="margin-top: 32px;">
          <?php
          $campaigns_query = new WP_Query(array(
              'post_type'      => 'cha_campaigns',
              'posts_per_page' => 12,
              'post_status'    => 'publish',
              'orderby'        => 'menu_order',
              'order'          => 'ASC',
          ));
          if ($campaigns_query->have_posts()) :
              while ($campaigns_query->have_posts()) : $campaigns_query->the_post();
                  $raised = (float) get_post_meta(get_the_ID(), '_cha_campaign_raised', true);
                  $goal = (float) get_post_meta(get_the_ID(), '_cha_campaign_goal', true);
                  $color = get_post_meta(get_the_ID(), '_cha_campaign_color', true);
                  if (!$color) $color = 'red';
                  $pct = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
                  ?>
                  <article class="campaign-card-v2 campaign-theme-<?php echo esc_attr($color); ?>" style="margin-bottom: 20px;" data-reveal>
                    <div class="campaign-card-top">
                      <div class="campaign-card-info" style="max-width: 100%;">
                        <?php
                        $camp_title = get_the_title();
                        $camp_km_title = get_post_meta(get_the_ID(), '_cha_campaign_title_km', true);
                        $camp_excerpt = get_the_excerpt();
                        $camp_km_desc = get_post_meta(get_the_ID(), '_cha_campaign_desc_km', true);
                        ?>
                        <div class="campaign-title-row">
                          <h4 class="campaign-title auto-text" data-en="<?php echo esc_attr($camp_title); ?>" data-km="<?php echo esc_attr($camp_km_title); ?>" style="font-size: 1.25rem;"><?php the_title(); ?></h4>
                          <span class="campaign-pct-pill"><?php echo esc_html($pct); ?>%</span>
                        </div>
                        <p class="campaign-desc auto-text" data-en="<?php echo esc_attr($camp_excerpt); ?>" data-km="<?php echo esc_attr($camp_km_desc); ?>"><?php echo esc_html($camp_excerpt); ?></p>
                      </div>
                    </div>
                    <div class="campaign-progress-track">
                      <div class="campaign-progress-fill fill-<?php echo esc_attr($color); ?>" style="width: <?php echo esc_attr($pct); ?>%"></div>
                    </div>
                    <div class="campaign-meta-row">
                      <span class="campaign-meta-raised" data-i18n="campaigns_raised_label">
                        Raised: <strong>$<?php echo esc_html(number_format($raised)); ?></strong>
                      </span>
                      <span class="campaign-meta-goal" data-i18n="campaigns_goal_label">
                        Goal: <span>$<?php echo esc_html(number_format($goal)); ?></span>
                      </span>
                    </div>
                  </article>
              <?php endwhile;
              wp_reset_postdata();
          else :
              ?>
              <div style="text-align: center; padding: 60px 20px;">
                <p style="font-size: 1.125rem; color: var(--c-muted);"><?php esc_html_e('No campaigns available at the moment.', 'cha-cambodia'); ?></p>
              </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
