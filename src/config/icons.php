<?php


class IconFactory {
    private static $icons = array(
        "fa-adjust",
        "fa-anchor",
        "fa-archive",
        "fa-asterisk",
        "fa-ban",
        "fa-bar-chart-o",
        "fa-barcode",
        "fa-beer",
        "fa-bell",
        "fa-bell-o",
        "fa-bolt",
        "fa-book",
        "fa-bookmark",
        "fa-bookmark-o",
        "fa-briefcase",
        "fa-bug",
        "fa-building",
        "fa-bullhorn",
        "fa-bullseye",
        "fa-calendar",
        "fa-calendar-o",
        "fa-camera",
        "fa-camera-retro",
        "fa-caret-square-o-down",
        "fa-caret-square-o-left",
        "fa-caret-square-o-right",
        "fa-caret-square-o-up",
        "fa-certificate",
        "fa-check",
        "fa-check-circle",
        "fa-check-circle-o",
        "fa-check-square",
        "fa-check-square-o",
        "fa-circle",
        "fa-circle-o",
        "fa-clock-o",
        "fa-cloud",
        "fa-cloud-download",
        "fa-cloud-upload",
        "fa-code",
        "fa-code-fork",
        "fa-coffee",
        "fa-cog",
        "fa-cogs",
        "fa-collapse-o",
        "fa-comment",
        "fa-comment-o",
        "fa-comments",
        "fa-comments-o",
        "fa-compass",
        "fa-credit-card",
        "fa-crop",
        "fa-crosshairs",
        "fa-cutlery",
        "fa-dashboard",
        "fa-desktop",
        "fa-dot-circle-o",
        "fa-download",
        "fa-edit",
        "fa-ellipsis-horizontal",
        "fa-ellipsis-vertical",
        "fa-envelope",
        "fa-envelope-o",
        "fa-eraser",
        "fa-exchange",
        "fa-exclamation",
        "fa-exclamation-circle",
        "fa-exclamation-triangle",
        "fa-expand-o",
        "fa-external-link",
        "fa-external-link-square",
        "fa-eye",
        "fa-eye-slash",
        "fa-female",
        "fa-fighter-jet",
        "fa-film",
        "fa-filter",
        "fa-fire",
        "fa-fire-extinguisher",
        "fa-flag",
        "fa-flag-checkered",
        "fa-flag-o",
        "fa-flash",
        "fa-flask",
        "fa-folder",
        "fa-folder-o",
        "fa-folder-open",
        "fa-folder-open-o",
        "fa-frown-o",
        "fa-gamepad",
        "fa-gavel",
        "fa-gear",
        "fa-gears",
        "fa-gift",
        "fa-glass",
        "fa-globe",
        "fa-group",
        "fa-hdd-o",
        "fa-headphones",
        "fa-heart",
        "fa-heart-o",
        "fa-home",
        "fa-inbox",
        "fa-info",
        "fa-info-circle",
        "fa-key",
        "fa-keyboard-o",
        "fa-laptop",
        "fa-leaf",
        "fa-legal",
        "fa-lemon-o",
        "fa-level-down",
        "fa-level-up",
        "fa-lightbulb-o",
        "fa-location-arrow",
        "fa-lock",
        "fa-magic",
        "fa-magnet",
        "fa-mail-forward",
        "fa-mail-reply",
        "fa-mail-reply-all",
        "fa-male",
        "fa-map-marker",
        "fa-meh-o",
        "fa-microphone",
        "fa-microphone-slash",
        "fa-minus",
        "fa-minus-circle",
        "fa-minus-square",
        "fa-minus-square-o",
        "fa-mobile",
        "fa-mobile-phone",
        "fa-money",
        "fa-moon-o",
        "fa-move",
        "fa-music",
        "fa-pencil",
        "fa-pencil-square",
        "fa-pencil-square-o",
        "fa-phone",
        "fa-phone-square",
        "fa-picture-o",
        "fa-plane",
        "fa-plus",
        "fa-plus-circle",
        "fa-plus-square",
        "fa-power-off",
        "fa-print",
        "fa-puzzle-piece",
        "fa-qrcode",
        "fa-question",
        "fa-question-circle",
        "fa-quote-left",
        "fa-quote-right",
        "fa-random",
        "fa-refresh",
        "fa-reorder",
        "fa-reply",
        "fa-reply-all",
        "fa-resize-horizontal",
        "fa-resize-vertical",
        "fa-retweet",
        "fa-road",
        "fa-rocket",
        "fa-rss",
        "fa-rss-square",
        "fa-search",
        "fa-search-minus",
        "fa-search-plus",
        "fa-share",
        "fa-share-square",
        "fa-share-square-o",
        "fa-shield",
        "fa-shopping-cart",
        "fa-sign-in",
        "fa-sign-out",
        "fa-signal",
        "fa-sitemap",
        "fa-smile-o",
        "fa-sort",
        "fa-sort-alpha-asc",
        "fa-sort-alpha-desc",
        "fa-sort-amount-asc",
        "fa-sort-amount-desc",
        "fa-sort-asc",
        "fa-sort-desc",
        "fa-sort-down",
        "fa-sort-numeric-asc",
        "fa-sort-numeric-desc",
        "fa-sort-up",
        "fa-spinner",
        "fa-square",
        "fa-square-o",
        "fa-star",
        "fa-star-half",
        "fa-star-half-empty",
        "fa-star-half-full",
        "fa-star-half-o",
        "fa-star-o",
        "fa-subscript",
        "fa-suitcase",
        "fa-sun-o",
        "fa-superscript",
        "fa-tablet",
        "fa-tachometer",
        "fa-tag",
        "fa-tags",
        "fa-tasks",
        "fa-terminal",
        "fa-thumb-tack",
        "fa-thumbs-down",
        "fa-thumbs-o-down",
        "fa-thumbs-o-up",
        "fa-thumbs-up",
        "fa-ticket",
        "fa-times",
        "fa-times-circle",
        "fa-times-circle-o",
        "fa-tint",
        "fa-toggle-down",
        "fa-toggle-left",
        "fa-toggle-right",
        "fa-toggle-up",
        "fa-trash-o",
        "fa-trophy",
        "fa-truck",
        "fa-umbrella",
        "fa-unlock",
        "fa-unlock-o",
        "fa-unsorted",
        "fa-upload",
        "fa-user",
        "fa-video-camera",
        "fa-volume-down",
        "fa-volume-off",
        "fa-volume-up",
        "fa-warning",
        "fa-wheelchair",
        "fa-wrench");

    private static $glyphicons = array(        
        "glyphicon-adjust",
        "glyphicon-align-center",
        "glyphicon-align-justify",
        "glyphicon-align-left",
        "glyphicon-align-right",
        "glyphicon-arrow-down",
        "glyphicon-arrow-left",
        "glyphicon-arrow-right",
        "glyphicon-arrow-up",
        "glyphicon-asterisk",
        "glyphicon-backward",
        "glyphicon-ban-circle",
        "glyphicon-barcode",
        "glyphicon-bell",
        "glyphicon-bold",
        "glyphicon-book",
        "glyphicon-bookmark",
        "glyphicon-briefcase",
        "glyphicon-bullhorn",
        "glyphicon-calendar",
        "glyphicon-camera",
        "glyphicon-certificate",
        "glyphicon-check",
        "glyphicon-chevron-down",
        "glyphicon-chevron-left",
        "glyphicon-chevron-right",
        "glyphicon-chevron-up",
        "glyphicon-circle-arrow-down",
        "glyphicon-circle-arrow-left",
        "glyphicon-circle-arrow-right",
        "glyphicon-circle-arrow-up",
        "glyphicon-cloud",
        "glyphicon-cloud-download",
        "glyphicon-cloud-upload",
        "glyphicon-cog",
        "glyphicon-collapse-down",
        "glyphicon-collapse-up",
        "glyphicon-comment",
        "glyphicon-compressed",
        "glyphicon-copyright-mark",
        "glyphicon-credit-card",
        "glyphicon-cutlery",
        "glyphicon-dashboard",
        "glyphicon-download",
        "glyphicon-download-alt",
        "glyphicon-earphone",
        "glyphicon-edit",
        "glyphicon-eject",
        "glyphicon-envelope",
        "glyphicon-euro",
        "glyphicon-exclamation-sign",
        "glyphicon-expand",
        "glyphicon-export",
        "glyphicon-eye-close",
        "glyphicon-eye-open",
        "glyphicon-facetime-video",
        "glyphicon-fast-backward",
        "glyphicon-fast-forward",
        "glyphicon-file",
        "glyphicon-film",
        "glyphicon-filter",
        "glyphicon-fire",
        "glyphicon-flag",
        "glyphicon-flash",
        "glyphicon-floppy-disk",
        "glyphicon-floppy-open",
        "glyphicon-floppy-remove",
        "glyphicon-floppy-save",
        "glyphicon-floppy-saved",
        "glyphicon-folder-close",
        "glyphicon-folder-open",
        "glyphicon-font",
        "glyphicon-forward",
        "glyphicon-fullscreen",
        "glyphicon-gbp",
        "glyphicon-gift",
        "glyphicon-glass",
        "glyphicon-globe",
        "glyphicon-hand-down",
        "glyphicon-hand-left",
        "glyphicon-hand-right",
        "glyphicon-hand-up",
        "glyphicon-hd-video",
        "glyphicon-hdd",
        "glyphicon-header",
        "glyphicon-headphones",
        "glyphicon-heart",
        "glyphicon-heart-empty",
        "glyphicon-home",
        "glyphicon-import",
        "glyphicon-inbox",
        "glyphicon-indent-left",
        "glyphicon-indent-right",
        "glyphicon-info-sign",
        "glyphicon-italic",
        "glyphicon-leaf",
        "glyphicon-link",
        "glyphicon-list",
        "glyphicon-list-alt",
        "glyphicon-lock",
        "glyphicon-log-in",
        "glyphicon-log-out",
        "glyphicon-magnet",
        "glyphicon-map-marker",
        "glyphicon-minus",
        "glyphicon-minus-sign",
        "glyphicon-move",
        "glyphicon-music",
        "glyphicon-new-window",
        "glyphicon-off",
        "glyphicon-ok",
        "glyphicon-ok-circle",
        "glyphicon-ok-sign",
        "glyphicon-open",
        "glyphicon-paperclip",
        "glyphicon-pause",
        "glyphicon-pencil",
        "glyphicon-phone",
        "glyphicon-phone-alt",
        "glyphicon-picture",
        "glyphicon-plane",
        "glyphicon-play",
        "glyphicon-play-circle",
        "glyphicon-plus",
        "glyphicon-plus-sign",
        "glyphicon-print",
        "glyphicon-pushpin",
        "glyphicon-qrcode",
        "glyphicon-question-sign",
        "glyphicon-random",
        "glyphicon-record",
        "glyphicon-refresh",
        "glyphicon-registration-mark",
        "glyphicon-remove",
        "glyphicon-remove-circle",
        "glyphicon-remove-sign",
        "glyphicon-repeat",
        "glyphicon-resize-full",
        "glyphicon-resize-horizontal",
        "glyphicon-resize-small",
        "glyphicon-resize-vertical",
        "glyphicon-retweet",
        "glyphicon-road",
        "glyphicon-save",
        "glyphicon-saved",
        "glyphicon-screenshot",
        "glyphicon-sd-video",
        "glyphicon-search",
        "glyphicon-send",
        "glyphicon-share",
        "glyphicon-share-alt",
        "glyphicon-shopping-cart",
        "glyphicon-signal",
        "glyphicon-sort",
        "glyphicon-sort-by-alphabet",
        "glyphicon-sort-by-alphabet-alt",
        "glyphicon-sort-by-attributes",
        "glyphicon-sort-by-attributes-alt",
        "glyphicon-sort-by-order",
        "glyphicon-sort-by-order-alt",
        "glyphicon-sound-5-1",
        "glyphicon-sound-6-1",
        "glyphicon-sound-7-1",
        "glyphicon-sound-dolby",
        "glyphicon-sound-stereo",
        "glyphicon-star",
        "glyphicon-star-empty",
        "glyphicon-stats",
        "glyphicon-step-backward",
        "glyphicon-step-forward",
        "glyphicon-stop",
        "glyphicon-subtitles",
        "glyphicon-tag",
        "glyphicon-tags",
        "glyphicon-tasks",
        "glyphicon-text-height",
        "glyphicon-text-width",
        "glyphicon-th",
        "glyphicon-th-large",
        "glyphicon-th-list",
        "glyphicon-thumbs-down",
        "glyphicon-thumbs-up",
        "glyphicon-time",
        "glyphicon-tint",
        "glyphicon-tower",
        "glyphicon-transfer",
        "glyphicon-trash",
        "glyphicon-tree-conifer",
        "glyphicon-tree-deciduous",
        "glyphicon-unchecked",
        "glyphicon-upload",
        "glyphicon-usd",
        "glyphicon-user",
        "glyphicon-volume-down",
        "glyphicon-volume-off",
        "glyphicon-volume-up",
        "glyphicon-warning-sign",
        "glyphicon-wrench",
        "glyphicon-zoom-in",
        "glyphicon-zoom-out");


    public static function get($icon, $size=null, $badge=null) {

        //Find icon:
        
        $search = preg_quote($icon, '~');
        $result = preg_grep('~' . $search . '~', self::$icons);

        if ($result) {
            $out = '<i class="fa fa-fw '.$size.' '.array_values($result)[0].'">';

            if ($badge) $out .= '<em>'.$badge.'</em>';

            $out .= '</i>';

            return $out;
        }

    }

}



class IconsFa {

    public static $icon_glass = "icon-glass";
    public static $icon_music = "icon-music";
    public static $icon_search = "icon-search";
    public static $icon_envelope_alt = "icon-envelope-alt";
    public static $icon_heart = "icon-heart";
    public static $icon_star = "icon-star";
    public static $icon_star_empty = "icon-star-empty";
    public static $icon_user = "icon-user";
    public static $icon_film = "icon-film";
    public static $icon_th_large = "icon-th-large";
    public static $icon_th = "icon-th";
    public static $icon_th_list = "icon-th-list";
    public static $icon_ok = "icon-ok";
    public static $icon_remove = "icon-remove";
    public static $icon_zoom_in = "icon-zoom-in";
    public static $icon_zoom_out = "icon-zoom-out";
    public static $icon_off = "icon-off";
    public static $icon_signal = "icon-signal";
    public static $icon_cog = "icon-cog";
    public static $icon_trash = "icon-trash";
    public static $icon_home = "icon-home";
    public static $icon_file_alt = "icon-file-alt";
    public static $icon_time = "icon-time";
    public static $icon_road = "icon-road";
    public static $icon_download_alt = "icon-download-alt";
    public static $icon_download = "icon-download";
    public static $icon_upload = "icon-upload";
    public static $icon_inbox = "icon-inbox";
    public static $icon_play_circle = "icon-play-circle";
    public static $icon_repeat = "icon-repeat";
    public static $icon_refresh = "icon-refresh";
    public static $icon_list_alt = "icon-list-alt";
    public static $icon_lock = "icon-lock";
    public static $icon_flag = "icon-flag";
    public static $icon_headphones = "icon-headphones";
    public static $icon_volume_off = "icon-volume-off";
    public static $icon_volume_down = "icon-volume-down";
    public static $icon_volume_up = "icon-volume-up";
    public static $icon_qrcode = "icon-qrcode";
    public static $icon_barcode = "icon-barcode";
    public static $icon_tag = "icon-tag";
    public static $icon_tags = "icon-tags";
    public static $icon_book = "icon-book";
    public static $icon_bookmark = "icon-bookmark";
    public static $icon_print = "icon-print";
    public static $icon_camera = "icon-camera";
    public static $icon_font = "icon-font";
    public static $icon_bold = "icon-bold";
    public static $icon_italic = "icon-italic";
    public static $icon_text_height = "icon-text-height";
    public static $icon_text_width = "icon-text-width";
    public static $icon_align_left = "icon-align-left";
    public static $icon_align_center = "icon-align-center";
    public static $icon_align_right = "icon-align-right";
    public static $icon_align_justify = "icon-align-justify";
    public static $icon_list = "icon-list";
    public static $icon_indent_left = "icon-indent-left";
    public static $icon_indent_right = "icon-indent-right";
    public static $icon_facetime_video = "icon-facetime-video";
    public static $icon_picture = "icon-picture";
    public static $icon_pencil = "icon-pencil";
    public static $icon_map_marker = "icon-map-marker";
    public static $icon_adjust = "icon-adjust";
    public static $icon_tint = "icon-tint";
    public static $icon_edit = "icon-edit";
    public static $icon_share = "icon-share";
    public static $icon_check = "icon-check";
    public static $icon_move = "icon-move";
    public static $icon_step_backward = "icon-step-backward";
    public static $icon_fast_backward = "icon-fast-backward";
    public static $icon_backward = "icon-backward";
    public static $icon_play = "icon-play";
    public static $icon_pause = "icon-pause";
    public static $icon_stop = "icon-stop";
    public static $icon_forward = "icon-forward";
    public static $icon_fast_forward = "icon-fast-forward";
    public static $icon_step_forward = "icon-step-forward";
    public static $icon_eject = "icon-eject";
    public static $icon_chevron_left = "icon-chevron-left";
    public static $icon_chevron_right = "icon-chevron-right";
    public static $icon_plus_sign = "icon-plus-sign";
    public static $icon_minus_sign = "icon-minus-sign";
    public static $icon_remove_sign = "icon-remove-sign";
    public static $icon_ok_sign = "icon-ok-sign";
    public static $icon_question_sign = "icon-question-sign";
    public static $icon_info_sign = "icon-info-sign";
    public static $icon_screenshot = "icon-screenshot";
    public static $icon_remove_circle = "icon-remove-circle";
    public static $icon_ok_circle = "icon-ok-circle";
    public static $icon_ban_circle = "icon-ban-circle";
    public static $icon_arrow_left = "icon-arrow-left";
    public static $icon_arrow_right = "icon-arrow-right";
    public static $icon_arrow_up = "icon-arrow-up";
    public static $icon_arrow_down = "icon-arrow-down";
    public static $icon_share_alt = "icon-share-alt";
    public static $icon_resize_full = "icon-resize-full";
    public static $icon_resize_small = "icon-resize-small";
    public static $icon_plus = "icon-plus";
    public static $icon_minus = "icon-minus";
    public static $icon_asterisk = "icon-asterisk";
    public static $icon_exclamation_sign = "icon-exclamation-sign";
    public static $icon_gift = "icon-gift";
    public static $icon_leaf = "icon-leaf";
    public static $icon_fire = "icon-fire";
    public static $icon_eye_open = "icon-eye-open";
    public static $icon_eye_close = "icon-eye-close";
    public static $icon_warning_sign = "icon-warning-sign";
    public static $icon_plane = "icon-plane";
    public static $icon_calendar = "icon-calendar";
    public static $icon_random = "icon-random";
    public static $icon_comment = "icon-comment";
    public static $icon_magnet = "icon-magnet";
    public static $icon_chevron_up = "icon-chevron-up";
    public static $icon_chevron_down = "icon-chevron-down";
    public static $icon_retweet = "icon-retweet";
    public static $icon_shopping_cart = "icon-shopping-cart";
    public static $icon_folder_close = "icon-folder-close";
    public static $icon_folder_open = "icon-folder-open";
    public static $icon_resize_vertical = "icon-resize-vertical";
    public static $icon_resize_horizontal = "icon-resize-horizontal";
    public static $icon_bar_chart = "icon-bar-chart";
    public static $icon_twitter_sign = "icon-twitter-sign";
    public static $icon_facebook_sign = "icon-facebook-sign";
    public static $icon_camera_retro = "icon-camera-retro";
    public static $icon_key = "icon-key";
    public static $icon_cogs = "icon-cogs";
    public static $icon_comments = "icon-comments";
    public static $icon_thumbs_up_alt = "icon-thumbs-up-alt";
    public static $icon_thumbs_down_alt = "icon-thumbs-down-alt";
    public static $icon_star_half = "icon-star-half";
    public static $icon_heart_empty = "icon-heart-empty";
    public static $icon_signout = "icon-signout";
    public static $icon_linkedin_sign = "icon-linkedin-sign";
    public static $icon_pushpin = "icon-pushpin";
    public static $icon_external_link = "icon-external-link";
    public static $icon_signin = "icon-signin";
    public static $icon_trophy = "icon-trophy";
    public static $icon_github_sign = "icon-github-sign";
    public static $icon_upload_alt = "icon-upload-alt";
    public static $icon_lemon = "icon-lemon";
    public static $icon_phone = "icon-phone";
    public static $icon_check_empty = "icon-check-empty";
    public static $icon_bookmark_empty = "icon-bookmark-empty";
    public static $icon_phone_sign = "icon-phone-sign";
    public static $icon_twitter = "icon-twitter";
    public static $icon_facebook = "icon-facebook";
    public static $icon_github = "icon-github";
    public static $icon_unlock = "icon-unlock";
    public static $icon_credit_card = "icon-credit-card";
    public static $icon_rss = "icon-rss";
    public static $icon_hdd = "icon-hdd";
    public static $icon_bullhorn = "icon-bullhorn";
    public static $icon_bell = "icon-bell";
    public static $icon_certificate = "icon-certificate";
    public static $icon_hand_right = "icon-hand-right";
    public static $icon_hand_left = "icon-hand-left";
    public static $icon_hand_up = "icon-hand-up";
    public static $icon_hand_down = "icon-hand-down";
    public static $icon_circle_arrow_left = "icon-circle-arrow-left";
    public static $icon_circle_arrow_right = "icon-circle-arrow-right";
    public static $icon_circle_arrow_up = "icon-circle-arrow-up";
    public static $icon_circle_arrow_down = "icon-circle-arrow-down";
    public static $icon_globe = "icon-globe";
    public static $icon_wrench = "icon-wrench";
    public static $icon_tasks = "icon-tasks";
    public static $icon_filter = "icon-filter";
    public static $icon_briefcase = "icon-briefcase";
    public static $icon_fullscreen = "icon-fullscreen";
    public static $icon_group = "icon-group";
    public static $icon_link = "icon-link";
    public static $icon_cloud = "icon-cloud";
    public static $icon_beaker = "icon-beaker";
    public static $icon_cut = "icon-cut";
    public static $icon_copy = "icon-copy";
    public static $icon_paper_clip = "icon-paper-clip";
    public static $icon_save = "icon-save";
    public static $icon_sign_blank = "icon-sign-blank";
    public static $icon_reorder = "icon-reorder";
    public static $icon_list_ul = "icon-list-ul";
    public static $icon_list_ol = "icon-list-ol";
    public static $icon_strikethrough = "icon-strikethrough";
    public static $icon_underline = "icon-underline";
    public static $icon_table = "icon-table";
    public static $icon_magic = "icon-magic";
    public static $icon_truck = "icon-truck";
    public static $icon_pinterest = "icon-pinterest";
    public static $icon_pinterest_sign = "icon-pinterest-sign";
    public static $icon_google_plus_sign = "icon-google-plus-sign";
    public static $icon_google_plus = "icon-google-plus";
    public static $icon_money = "icon-money";
    public static $icon_caret_down = "icon-caret-down";
    public static $icon_caret_up = "icon-caret-up";
    public static $icon_caret_left = "icon-caret-left";
    public static $icon_caret_right = "icon-caret-right";
    public static $icon_columns = "icon-columns";
    public static $icon_sort = "icon-sort";
    public static $icon_sort_down = "icon-sort-down";
    public static $icon_sort_up = "icon-sort-up";
    public static $icon_envelope = "icon-envelope";
    public static $icon_linkedin = "icon-linkedin";
    public static $icon_undo = "icon-undo";
    public static $icon_legal = "icon-legal";
    public static $icon_dashboard = "icon-dashboard";
    public static $icon_comment_alt = "icon-comment-alt";
    public static $icon_comments_alt = "icon-comments-alt";
    public static $icon_bolt = "icon-bolt";
    public static $icon_sitemap = "icon-sitemap";
    public static $icon_umbrella = "icon-umbrella";
    public static $icon_paste = "icon-paste";
    public static $icon_lightbulb = "icon-lightbulb";
    public static $icon_exchange = "icon-exchange";
    public static $icon_cloud_download = "icon-cloud-download";
    public static $icon_cloud_upload = "icon-cloud-upload";
    public static $icon_user_md = "icon-user-md";
    public static $icon_stethoscope = "icon-stethoscope";
    public static $icon_suitcase = "icon-suitcase";
    public static $icon_bell_alt = "icon-bell-alt";
    public static $icon_coffee = "icon-coffee";
    public static $icon_food = "icon-food";
    public static $icon_file_text_alt = "icon-file-text-alt";
    public static $icon_building = "icon-building";
    public static $icon_hospital = "icon-hospital";
    public static $icon_ambulance = "icon-ambulance";
    public static $icon_medkit = "icon-medkit";
    public static $icon_fighter_jet = "icon-fighter-jet";
    public static $icon_beer = "icon-beer";
    public static $icon_h_sign = "icon-h-sign";
    public static $icon_plus_sign_alt = "icon-plus-sign-alt";
    public static $icon_double_angle_left = "icon-double-angle-left";
    public static $icon_double_angle_right = "icon-double-angle-right";
    public static $icon_double_angle_up = "icon-double-angle-up";
    public static $icon_double_angle_down = "icon-double-angle-down";
    public static $icon_angle_left = "icon-angle-left";
    public static $icon_angle_right = "icon-angle-right";
    public static $icon_angle_up = "icon-angle-up";
    public static $icon_angle_down = "icon-angle-down";
    public static $icon_desktop = "icon-desktop";
    public static $icon_laptop = "icon-laptop";
    public static $icon_tablet = "icon-tablet";
    public static $icon_mobile_phone = "icon-mobile-phone";
    public static $icon_circle_blank = "icon-circle-blank";
    public static $icon_quote_left = "icon-quote-left";
    public static $icon_quote_right = "icon-quote-right";
    public static $icon_spinner = "icon-spinner";
    public static $icon_circle = "icon-circle";
    public static $icon_reply = "icon-reply";
    public static $icon_github_alt = "icon-github-alt";
    public static $icon_folder_close_alt = "icon-folder-close-alt";
    public static $icon_folder_open_alt = "icon-folder-open-alt";
    public static $icon_expand_alt = "icon-expand-alt";
    public static $icon_collapse_alt = "icon-collapse-alt";
    public static $icon_smile = "icon-smile";
    public static $icon_frown = "icon-frown";
    public static $icon_meh = "icon-meh";
    public static $icon_gamepad = "icon-gamepad";
    public static $icon_keyboard = "icon-keyboard";
    public static $icon_flag_alt = "icon-flag-alt";
    public static $icon_flag_checkered = "icon-flag-checkered";
    public static $icon_terminal = "icon-terminal";
    public static $icon_code = "icon-code";
    public static $icon_reply_all = "icon-reply-all";
    public static $icon_mail_reply_all = "icon-mail-reply-all";
    public static $icon_star_half_empty = "icon-star-half-empty";
    public static $icon_location_arrow = "icon-location-arrow";
    public static $icon_crop = "icon-crop";
    public static $icon_code_fork = "icon-code-fork";
    public static $icon_unlink = "icon-unlink";
    public static $icon_question = "icon-question";
    public static $icon_info = "icon-info";
    public static $icon_exclamation = "icon-exclamation";
    public static $icon_superscript = "icon-superscript";
    public static $icon_subscript = "icon-subscript";
    public static $icon_eraser = "icon-eraser";
    public static $icon_puzzle_piece = "icon-puzzle-piece";
    public static $icon_microphone = "icon-microphone";
    public static $icon_microphone_off = "icon-microphone-off";
    public static $icon_shield = "icon-shield";
    public static $icon_calendar_empty = "icon-calendar-empty";
    public static $icon_fire_extinguisher = "icon-fire-extinguisher";
    public static $icon_rocket = "icon-rocket";
    public static $icon_maxcdn = "icon-maxcdn";
    public static $icon_chevron_sign_left = "icon-chevron-sign-left";
    public static $icon_chevron_sign_right = "icon-chevron-sign-right";
    public static $icon_chevron_sign_up = "icon-chevron-sign-up";
    public static $icon_chevron_sign_down = "icon-chevron-sign-down";
    public static $icon_html5 = "icon-html5";
    public static $icon_css3 = "icon-css3";
    public static $icon_anchor = "icon-anchor";
    public static $icon_unlock_alt = "icon-unlock-alt";
    public static $icon_bullseye = "icon-bullseye";
    public static $icon_ellipsis_horizontal = "icon-ellipsis-horizontal";
    public static $icon_ellipsis_vertical = "icon-ellipsis-vertical";
    public static $icon_rss_sign = "icon-rss-sign";
    public static $icon_play_sign = "icon-play-sign";
    public static $icon_ticket = "icon-ticket";
    public static $icon_minus_sign_alt = "icon-minus-sign-alt";
    public static $icon_check_minus = "icon-check-minus";
    public static $icon_level_up = "icon-level-up";
    public static $icon_level_down = "icon-level-down";
    public static $icon_check_sign = "icon-check-sign";
    public static $icon_edit_sign = "icon-edit-sign";
    public static $icon_external_link_sign = "icon-external-link-sign";
    public static $icon_share_sign = "icon-share-sign";
    public static $icon_compass = "icon-compass";
    public static $icon_collapse = "icon-collapse";
    public static $icon_collapse_top = "icon-collapse-top";
    public static $icon_expand = "icon-expand";
    public static $icon_eur = "icon-eur";
    public static $icon_gbp = "icon-gbp";
    public static $icon_usd = "icon-usd";
    public static $icon_inr = "icon-inr";
    public static $icon_jpy = "icon-jpy";
    public static $icon_cny = "icon-cny";
    public static $icon_krw = "icon-krw";
    public static $icon_btc = "icon-btc";
    public static $icon_file = "icon-file";
    public static $icon_file_text = "icon-file-text";
    public static $icon_sort_by_alphabet = "icon-sort-by-alphabet";
    public static $icon_sort_by_alphabet_alt = "icon-sort-by-alphabet-alt";
    public static $icon_sort_by_attributes = "icon-sort-by-attributes";
    public static $icon_sort_by_attributes_alt = "icon-sort-by-attributes-alt";
    public static $icon_sort_by_order = "icon-sort-by-order";
    public static $icon_sort_by_order_alt = "icon-sort-by-order-alt";
    public static $icon_thumbs_up = "icon-thumbs-up";
    public static $icon_thumbs_down = "icon-thumbs-down";
    public static $icon_youtube_sign = "icon-youtube-sign";
    public static $icon_youtube = "icon-youtube";
    public static $icon_xing = "icon-xing";
    public static $icon_xing_sign = "icon-xing-sign";
    public static $icon_youtube_play = "icon-youtube-play";
    public static $icon_dropbox = "icon-dropbox";
    public static $icon_stackexchange = "icon-stackexchange";
    public static $icon_instagram = "icon-instagram";
    public static $icon_flickr = "icon-flickr";
    public static $icon_adn = "icon-adn";
    public static $icon_bitbucket = "icon-bitbucket";
    public static $icon_bitbucket_sign = "icon-bitbucket-sign";
    public static $icon_tumblr = "icon-tumblr";
    public static $icon_tumblr_sign = "icon-tumblr-sign";
    public static $icon_long_arrow_down = "icon-long-arrow-down";
    public static $icon_long_arrow_up = "icon-long-arrow-up";
    public static $icon_long_arrow_left = "icon-long-arrow-left";
    public static $icon_long_arrow_right = "icon-long-arrow-right";
    public static $icon_apple = "icon-apple";
    public static $icon_windows = "icon-windows";
    public static $icon_android = "icon-android";
    public static $icon_linux = "icon-linux";
    public static $icon_dribbble = "icon-dribbble";
    public static $icon_skype = "icon-skype";
    public static $icon_foursquare = "icon-foursquare";
    public static $icon_trello = "icon-trello";
    public static $icon_female = "icon-female";
    public static $icon_male = "icon-male";
    public static $icon_gittip = "icon-gittip";
    public static $icon_sun = "icon-sun";
    public static $icon_moon = "icon-moon";
    public static $icon_archive = "icon-archive";
    public static $icon_bug = "icon-bug";
    public static $icon_vk = "icon-vk";
    public static $icon_weibo = "icon-weibo";
    public static $icon_renren = "icon-renren";

    public static $color_dark = "dark";
    public static $color_white = "white";
    public static $color_red = "red";
    public static $color_lightred = "light-red";
    public static $color_blue = "blue";
    public static $color_lightblue = "light-blue";
    public static $color_green = "green";
    public static $color_lightgreen = "light-green";
    public static $color_orange = "orange";
    public static $color_lightorange = "light-orange";
    public static $color_orange2 = "orange2";
    public static $color_purple = "purple";
    public static $color_pink = "pink";
    public static $color_pink2 = "pink2";
    public static $color_brown = "brown";
    public static $color_grey = "grey";
    public static $color_lightgrey = "light-grey";

    public static $bigger_110 = "bigger-110";
    public static $bigger_120 = "bigger-120";
    public static $bigger_130 = "bigger-130";
    public static $bigger_140 = "bigger-140";
    public static $bigger_150 = "bigger-150";
    public static $bigger_160 = "bigger-160";
    public static $bigger_170 = "bigger-170";
    public static $bigger_180 = "bigger-180";
    public static $bigger_190 = "bigger-190";
    public static $bigger_200 = "bigger-200";
    public static $bigger_210 = "bigger-210";
    public static $bigger_220 = "bigger-220";
    public static $bigger_230 = "bigger-230";
    public static $bigger_240 = "bigger-240";
    public static $bigger_250 = "bigger-250";
    public static $bigger_260 = "bigger-260";
    public static $bigger_270 = "bigger-270";
    public static $bigger_280 = "bigger-280";
    public static $bigger_290 = "bigger-290";
    public static $bigger_300 = "bigger-300";
    public static $bigger_125 = "bigger-125";
    public static $bigger_175 = "bigger-175";
    public static $bigger_225 = "bigger-225";
    public static $bigger_275 = "bigger-275";
    public static $smaller_90 = "smaller-90";
    public static $smaller_80 = "smaller-80";
    public static $smaller_70 = "smaller-70";
    public static $smaller_60 = "smaller-60";
    public static $smaller_50 = "smaller-50";
    public static $smaller_40 = "smaller-40";
    public static $smaller_30 = "smaller-30";
    public static $smaller_20 = "smaller-20";
    public static $smaller_75 = "smaller-75";
}

class Icons {

    public static $icon_glass = "icon-glass";
    public static $icon_music = "icon-music";
    public static $icon_search = "icon-search";
    public static $icon_envelope_alt = "icon-envelope-alt";
    public static $icon_heart = "icon-heart";
    public static $icon_star = "icon-star";
    public static $icon_star_empty = "icon-star-empty";
    public static $icon_user = "icon-user";
    public static $icon_film = "icon-film";
    public static $icon_th_large = "icon-th-large";
    public static $icon_th = "icon-th";
    public static $icon_th_list = "icon-th-list";
    public static $icon_ok = "icon-ok";
    public static $icon_remove = "icon-remove";
    public static $icon_zoom_in = "icon-zoom-in";
    public static $icon_zoom_out = "icon-zoom-out";
    public static $icon_off = "icon-off";
    public static $icon_signal = "icon-signal";
    public static $icon_cog = "icon-cog";
    public static $icon_trash = "icon-trash";
    public static $icon_home = "icon-home";
    public static $icon_file_alt = "icon-file-alt";
    public static $icon_time = "icon-time";
    public static $icon_road = "icon-road";
    public static $icon_download_alt = "icon-download-alt";
    public static $icon_download = "icon-download";
    public static $icon_upload = "icon-upload";
    public static $icon_inbox = "icon-inbox";
    public static $icon_play_circle = "icon-play-circle";
    public static $icon_repeat = "icon-repeat";
    public static $icon_refresh = "icon-refresh";
    public static $icon_list_alt = "icon-list-alt";
    public static $icon_lock = "icon-lock";
    public static $icon_flag = "icon-flag";
    public static $icon_headphones = "icon-headphones";
    public static $icon_volume_off = "icon-volume-off";
    public static $icon_volume_down = "icon-volume-down";
    public static $icon_volume_up = "icon-volume-up";
    public static $icon_qrcode = "icon-qrcode";
    public static $icon_barcode = "icon-barcode";
    public static $icon_tag = "icon-tag";
    public static $icon_tags = "icon-tags";
    public static $icon_book = "icon-book";
    public static $icon_bookmark = "icon-bookmark";
    public static $icon_print = "icon-print";
    public static $icon_camera = "icon-camera";
    public static $icon_font = "icon-font";
    public static $icon_bold = "icon-bold";
    public static $icon_italic = "icon-italic";
    public static $icon_text_height = "icon-text-height";
    public static $icon_text_width = "icon-text-width";
    public static $icon_align_left = "icon-align-left";
    public static $icon_align_center = "icon-align-center";
    public static $icon_align_right = "icon-align-right";
    public static $icon_align_justify = "icon-align-justify";
    public static $icon_list = "icon-list";
    public static $icon_indent_left = "icon-indent-left";
    public static $icon_indent_right = "icon-indent-right";
    public static $icon_facetime_video = "icon-facetime-video";
    public static $icon_picture = "icon-picture";
    public static $icon_pencil = "icon-pencil";
    public static $icon_map_marker = "icon-map-marker";
    public static $icon_adjust = "icon-adjust";
    public static $icon_tint = "icon-tint";
    public static $icon_edit = "icon-edit";
    public static $icon_share = "icon-share";
    public static $icon_check = "icon-check";
    public static $icon_move = "icon-move";
    public static $icon_step_backward = "icon-step-backward";
    public static $icon_fast_backward = "icon-fast-backward";
    public static $icon_backward = "icon-backward";
    public static $icon_play = "icon-play";
    public static $icon_pause = "icon-pause";
    public static $icon_stop = "icon-stop";
    public static $icon_forward = "icon-forward";
    public static $icon_fast_forward = "icon-fast-forward";
    public static $icon_step_forward = "icon-step-forward";
    public static $icon_eject = "icon-eject";
    public static $icon_chevron_left = "icon-chevron-left";
    public static $icon_chevron_right = "icon-chevron-right";
    public static $icon_plus_sign = "icon-plus-sign";
    public static $icon_minus_sign = "icon-minus-sign";
    public static $icon_remove_sign = "icon-remove-sign";
    public static $icon_ok_sign = "icon-ok-sign";
    public static $icon_question_sign = "icon-question-sign";
    public static $icon_info_sign = "icon-info-sign";
    public static $icon_screenshot = "icon-screenshot";
    public static $icon_remove_circle = "icon-remove-circle";
    public static $icon_ok_circle = "icon-ok-circle";
    public static $icon_ban_circle = "icon-ban-circle";
    public static $icon_arrow_left = "icon-arrow-left";
    public static $icon_arrow_right = "icon-arrow-right";
    public static $icon_arrow_up = "icon-arrow-up";
    public static $icon_arrow_down = "icon-arrow-down";
    public static $icon_share_alt = "icon-share-alt";
    public static $icon_resize_full = "icon-resize-full";
    public static $icon_resize_small = "icon-resize-small";
    public static $icon_plus = "icon-plus";
    public static $icon_minus = "icon-minus";
    public static $icon_asterisk = "icon-asterisk";
    public static $icon_exclamation_sign = "icon-exclamation-sign";
    public static $icon_gift = "icon-gift";
    public static $icon_leaf = "icon-leaf";
    public static $icon_fire = "icon-fire";
    public static $icon_eye_open = "icon-eye-open";
    public static $icon_eye_close = "icon-eye-close";
    public static $icon_warning_sign = "icon-warning-sign";
    public static $icon_plane = "icon-plane";
    public static $icon_calendar = "icon-calendar";
    public static $icon_random = "icon-random";
    public static $icon_comment = "icon-comment";
    public static $icon_magnet = "icon-magnet";
    public static $icon_chevron_up = "icon-chevron-up";
    public static $icon_chevron_down = "icon-chevron-down";
    public static $icon_retweet = "icon-retweet";
    public static $icon_shopping_cart = "icon-shopping-cart";
    public static $icon_folder_close = "icon-folder-close";
    public static $icon_folder_open = "icon-folder-open";
    public static $icon_resize_vertical = "icon-resize-vertical";
    public static $icon_resize_horizontal = "icon-resize-horizontal";
    public static $icon_bar_chart = "icon-bar-chart";
    public static $icon_twitter_sign = "icon-twitter-sign";
    public static $icon_facebook_sign = "icon-facebook-sign";
    public static $icon_camera_retro = "icon-camera-retro";
    public static $icon_key = "icon-key";
    public static $icon_cogs = "icon-cogs";
    public static $icon_comments = "icon-comments";
    public static $icon_thumbs_up_alt = "icon-thumbs-up-alt";
    public static $icon_thumbs_down_alt = "icon-thumbs-down-alt";
    public static $icon_star_half = "icon-star-half";
    public static $icon_heart_empty = "icon-heart-empty";
    public static $icon_signout = "icon-signout";
    public static $icon_linkedin_sign = "icon-linkedin-sign";
    public static $icon_pushpin = "icon-pushpin";
    public static $icon_external_link = "icon-external-link";
    public static $icon_signin = "icon-signin";
    public static $icon_trophy = "icon-trophy";
    public static $icon_github_sign = "icon-github-sign";
    public static $icon_upload_alt = "icon-upload-alt";
    public static $icon_lemon = "icon-lemon";
    public static $icon_phone = "icon-phone";
    public static $icon_check_empty = "icon-check-empty";
    public static $icon_bookmark_empty = "icon-bookmark-empty";
    public static $icon_phone_sign = "icon-phone-sign";
    public static $icon_twitter = "icon-twitter";
    public static $icon_facebook = "icon-facebook";
    public static $icon_github = "icon-github";
    public static $icon_unlock = "icon-unlock";
    public static $icon_credit_card = "icon-credit-card";
    public static $icon_rss = "icon-rss";
    public static $icon_hdd = "icon-hdd";
    public static $icon_bullhorn = "icon-bullhorn";
    public static $icon_bell = "icon-bell";
    public static $icon_certificate = "icon-certificate";
    public static $icon_hand_right = "icon-hand-right";
    public static $icon_hand_left = "icon-hand-left";
    public static $icon_hand_up = "icon-hand-up";
    public static $icon_hand_down = "icon-hand-down";
    public static $icon_circle_arrow_left = "icon-circle-arrow-left";
    public static $icon_circle_arrow_right = "icon-circle-arrow-right";
    public static $icon_circle_arrow_up = "icon-circle-arrow-up";
    public static $icon_circle_arrow_down = "icon-circle-arrow-down";
    public static $icon_globe = "icon-globe";
    public static $icon_wrench = "icon-wrench";
    public static $icon_tasks = "icon-tasks";
    public static $icon_filter = "icon-filter";
    public static $icon_briefcase = "icon-briefcase";
    public static $icon_fullscreen = "icon-fullscreen";
    public static $icon_group = "icon-group";
    public static $icon_link = "icon-link";
    public static $icon_cloud = "icon-cloud";
    public static $icon_beaker = "icon-beaker";
    public static $icon_cut = "icon-cut";
    public static $icon_copy = "icon-copy";
    public static $icon_paper_clip = "icon-paper-clip";
    public static $icon_save = "icon-save";
    public static $icon_sign_blank = "icon-sign-blank";
    public static $icon_reorder = "icon-reorder";
    public static $icon_list_ul = "icon-list-ul";
    public static $icon_list_ol = "icon-list-ol";
    public static $icon_strikethrough = "icon-strikethrough";
    public static $icon_underline = "icon-underline";
    public static $icon_table = "icon-table";
    public static $icon_magic = "icon-magic";
    public static $icon_truck = "icon-truck";
    public static $icon_pinterest = "icon-pinterest";
    public static $icon_pinterest_sign = "icon-pinterest-sign";
    public static $icon_google_plus_sign = "icon-google-plus-sign";
    public static $icon_google_plus = "icon-google-plus";
    public static $icon_money = "icon-money";
    public static $icon_caret_down = "icon-caret-down";
    public static $icon_caret_up = "icon-caret-up";
    public static $icon_caret_left = "icon-caret-left";
    public static $icon_caret_right = "icon-caret-right";
    public static $icon_columns = "icon-columns";
    public static $icon_sort = "icon-sort";
    public static $icon_sort_down = "icon-sort-down";
    public static $icon_sort_up = "icon-sort-up";
    public static $icon_envelope = "icon-envelope";
    public static $icon_linkedin = "icon-linkedin";
    public static $icon_undo = "icon-undo";
    public static $icon_legal = "icon-legal";
    public static $icon_dashboard = "icon-dashboard";
    public static $icon_comment_alt = "icon-comment-alt";
    public static $icon_comments_alt = "icon-comments-alt";
    public static $icon_bolt = "icon-bolt";
    public static $icon_sitemap = "icon-sitemap";
    public static $icon_umbrella = "icon-umbrella";
    public static $icon_paste = "icon-paste";
    public static $icon_lightbulb = "icon-lightbulb";
    public static $icon_exchange = "icon-exchange";
    public static $icon_cloud_download = "icon-cloud-download";
    public static $icon_cloud_upload = "icon-cloud-upload";
    public static $icon_user_md = "icon-user-md";
    public static $icon_stethoscope = "icon-stethoscope";
    public static $icon_suitcase = "icon-suitcase";
    public static $icon_bell_alt = "icon-bell-alt";
    public static $icon_coffee = "icon-coffee";
    public static $icon_food = "icon-food";
    public static $icon_file_text_alt = "icon-file-text-alt";
    public static $icon_building = "icon-building";
    public static $icon_hospital = "icon-hospital";
    public static $icon_ambulance = "icon-ambulance";
    public static $icon_medkit = "icon-medkit";
    public static $icon_fighter_jet = "icon-fighter-jet";
    public static $icon_beer = "icon-beer";
    public static $icon_h_sign = "icon-h-sign";
    public static $icon_plus_sign_alt = "icon-plus-sign-alt";
    public static $icon_double_angle_left = "icon-double-angle-left";
    public static $icon_double_angle_right = "icon-double-angle-right";
    public static $icon_double_angle_up = "icon-double-angle-up";
    public static $icon_double_angle_down = "icon-double-angle-down";
    public static $icon_angle_left = "icon-angle-left";
    public static $icon_angle_right = "icon-angle-right";
    public static $icon_angle_up = "icon-angle-up";
    public static $icon_angle_down = "icon-angle-down";
    public static $icon_desktop = "icon-desktop";
    public static $icon_laptop = "icon-laptop";
    public static $icon_tablet = "icon-tablet";
    public static $icon_mobile_phone = "icon-mobile-phone";
    public static $icon_circle_blank = "icon-circle-blank";
    public static $icon_quote_left = "icon-quote-left";
    public static $icon_quote_right = "icon-quote-right";
    public static $icon_spinner = "icon-spinner";
    public static $icon_circle = "icon-circle";
    public static $icon_reply = "icon-reply";
    public static $icon_github_alt = "icon-github-alt";
    public static $icon_folder_close_alt = "icon-folder-close-alt";
    public static $icon_folder_open_alt = "icon-folder-open-alt";
    public static $icon_expand_alt = "icon-expand-alt";
    public static $icon_collapse_alt = "icon-collapse-alt";
    public static $icon_smile = "icon-smile";
    public static $icon_frown = "icon-frown";
    public static $icon_meh = "icon-meh";
    public static $icon_gamepad = "icon-gamepad";
    public static $icon_keyboard = "icon-keyboard";
    public static $icon_flag_alt = "icon-flag-alt";
    public static $icon_flag_checkered = "icon-flag-checkered";
    public static $icon_terminal = "icon-terminal";
    public static $icon_code = "icon-code";
    public static $icon_reply_all = "icon-reply-all";
    public static $icon_mail_reply_all = "icon-mail-reply-all";
    public static $icon_star_half_empty = "icon-star-half-empty";
    public static $icon_location_arrow = "icon-location-arrow";
    public static $icon_crop = "icon-crop";
    public static $icon_code_fork = "icon-code-fork";
    public static $icon_unlink = "icon-unlink";
    public static $icon_question = "icon-question";
    public static $icon_info = "icon-info";
    public static $icon_exclamation = "icon-exclamation";
    public static $icon_superscript = "icon-superscript";
    public static $icon_subscript = "icon-subscript";
    public static $icon_eraser = "icon-eraser";
    public static $icon_puzzle_piece = "icon-puzzle-piece";
    public static $icon_microphone = "icon-microphone";
    public static $icon_microphone_off = "icon-microphone-off";
    public static $icon_shield = "icon-shield";
    public static $icon_calendar_empty = "icon-calendar-empty";
    public static $icon_fire_extinguisher = "icon-fire-extinguisher";
    public static $icon_rocket = "icon-rocket";
    public static $icon_maxcdn = "icon-maxcdn";
    public static $icon_chevron_sign_left = "icon-chevron-sign-left";
    public static $icon_chevron_sign_right = "icon-chevron-sign-right";
    public static $icon_chevron_sign_up = "icon-chevron-sign-up";
    public static $icon_chevron_sign_down = "icon-chevron-sign-down";
    public static $icon_html5 = "icon-html5";
    public static $icon_css3 = "icon-css3";
    public static $icon_anchor = "icon-anchor";
    public static $icon_unlock_alt = "icon-unlock-alt";
    public static $icon_bullseye = "icon-bullseye";
    public static $icon_ellipsis_horizontal = "icon-ellipsis-horizontal";
    public static $icon_ellipsis_vertical = "icon-ellipsis-vertical";
    public static $icon_rss_sign = "icon-rss-sign";
    public static $icon_play_sign = "icon-play-sign";
    public static $icon_ticket = "icon-ticket";
    public static $icon_minus_sign_alt = "icon-minus-sign-alt";
    public static $icon_check_minus = "icon-check-minus";
    public static $icon_level_up = "icon-level-up";
    public static $icon_level_down = "icon-level-down";
    public static $icon_check_sign = "icon-check-sign";
    public static $icon_edit_sign = "icon-edit-sign";
    public static $icon_external_link_sign = "icon-external-link-sign";
    public static $icon_share_sign = "icon-share-sign";
    public static $icon_compass = "icon-compass";
    public static $icon_collapse = "icon-collapse";
    public static $icon_collapse_top = "icon-collapse-top";
    public static $icon_expand = "icon-expand";
    public static $icon_eur = "icon-eur";
    public static $icon_gbp = "icon-gbp";
    public static $icon_usd = "icon-usd";
    public static $icon_inr = "icon-inr";
    public static $icon_jpy = "icon-jpy";
    public static $icon_cny = "icon-cny";
    public static $icon_krw = "icon-krw";
    public static $icon_btc = "icon-btc";
    public static $icon_file = "icon-file";
    public static $icon_file_text = "icon-file-text";
    public static $icon_sort_by_alphabet = "icon-sort-by-alphabet";
    public static $icon_sort_by_alphabet_alt = "icon-sort-by-alphabet-alt";
    public static $icon_sort_by_attributes = "icon-sort-by-attributes";
    public static $icon_sort_by_attributes_alt = "icon-sort-by-attributes-alt";
    public static $icon_sort_by_order = "icon-sort-by-order";
    public static $icon_sort_by_order_alt = "icon-sort-by-order-alt";
    public static $icon_thumbs_up = "icon-thumbs-up";
    public static $icon_thumbs_down = "icon-thumbs-down";
    public static $icon_youtube_sign = "icon-youtube-sign";
    public static $icon_youtube = "icon-youtube";
    public static $icon_xing = "icon-xing";
    public static $icon_xing_sign = "icon-xing-sign";
    public static $icon_youtube_play = "icon-youtube-play";
    public static $icon_dropbox = "icon-dropbox";
    public static $icon_stackexchange = "icon-stackexchange";
    public static $icon_instagram = "icon-instagram";
    public static $icon_flickr = "icon-flickr";
    public static $icon_adn = "icon-adn";
    public static $icon_bitbucket = "icon-bitbucket";
    public static $icon_bitbucket_sign = "icon-bitbucket-sign";
    public static $icon_tumblr = "icon-tumblr";
    public static $icon_tumblr_sign = "icon-tumblr-sign";
    public static $icon_long_arrow_down = "icon-long-arrow-down";
    public static $icon_long_arrow_up = "icon-long-arrow-up";
    public static $icon_long_arrow_left = "icon-long-arrow-left";
    public static $icon_long_arrow_right = "icon-long-arrow-right";
    public static $icon_apple = "icon-apple";
    public static $icon_windows = "icon-windows";
    public static $icon_android = "icon-android";
    public static $icon_linux = "icon-linux";
    public static $icon_dribbble = "icon-dribbble";
    public static $icon_skype = "icon-skype";
    public static $icon_foursquare = "icon-foursquare";
    public static $icon_trello = "icon-trello";
    public static $icon_female = "icon-female";
    public static $icon_male = "icon-male";
    public static $icon_gittip = "icon-gittip";
    public static $icon_sun = "icon-sun";
    public static $icon_moon = "icon-moon";
    public static $icon_archive = "icon-archive";
    public static $icon_bug = "icon-bug";
    public static $icon_vk = "icon-vk";
    public static $icon_weibo = "icon-weibo";
    public static $icon_renren = "icon-renren";

    public static $color_dark = "dark";
    public static $color_white = "white";
    public static $color_red = "red";
    public static $color_lightred = "light-red";
    public static $color_blue = "blue";
    public static $color_lightblue = "light-blue";
    public static $color_green = "green";
    public static $color_lightgreen = "light-green";
    public static $color_orange = "orange";
    public static $color_lightorange = "light-orange";
    public static $color_orange2 = "orange2";
    public static $color_purple = "purple";
    public static $color_pink = "pink";
    public static $color_pink2 = "pink2";
    public static $color_brown = "brown";
    public static $color_grey = "grey";
    public static $color_lightgrey = "light-grey";

    public static $bigger_110 = "bigger-110";
    public static $bigger_120 = "bigger-120";
    public static $bigger_130 = "bigger-130";
    public static $bigger_140 = "bigger-140";
    public static $bigger_150 = "bigger-150";
    public static $bigger_160 = "bigger-160";
    public static $bigger_170 = "bigger-170";
    public static $bigger_180 = "bigger-180";
    public static $bigger_190 = "bigger-190";
    public static $bigger_200 = "bigger-200";
    public static $bigger_210 = "bigger-210";
    public static $bigger_220 = "bigger-220";
    public static $bigger_230 = "bigger-230";
    public static $bigger_240 = "bigger-240";
    public static $bigger_250 = "bigger-250";
    public static $bigger_260 = "bigger-260";
    public static $bigger_270 = "bigger-270";
    public static $bigger_280 = "bigger-280";
    public static $bigger_290 = "bigger-290";
    public static $bigger_300 = "bigger-300";
    public static $bigger_125 = "bigger-125";
    public static $bigger_175 = "bigger-175";
    public static $bigger_225 = "bigger-225";
    public static $bigger_275 = "bigger-275";
    public static $smaller_90 = "smaller-90";
    public static $smaller_80 = "smaller-80";
    public static $smaller_70 = "smaller-70";
    public static $smaller_60 = "smaller-60";
    public static $smaller_50 = "smaller-50";
    public static $smaller_40 = "smaller-40";
    public static $smaller_30 = "smaller-30";
    public static $smaller_20 = "smaller-20";
    public static $smaller_75 = "smaller-75";
}