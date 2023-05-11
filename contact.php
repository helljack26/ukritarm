<?php 
include('includes/config.php');
include_once('function.php');

// Real title 15
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];
// Real title end
$getPageContent = mysqli_query($con,"SELECT * FROM page_content WHERE newid='3'");

if ($getPageContent) {
    $rowPageContent = mysqli_fetch_array($getPageContent);
    $soc_description = $rowPageContent['soc_info_description'];
    $parsedData = unserialize($rowPageContent['text']);
}

$socialFooterContent = getPageContent($con,'7');

$facebook_link = html_entity_decode($socialFooterContent['footer_social_facebook']);                           
$youtube_link = html_entity_decode($socialFooterContent['footer_social_youtube']);
$instagram_link = html_entity_decode($socialFooterContent['footer_social_instagram']);

?>

<!DOCTYPE html>

<html lang="uk">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta property="og:image" content="assets/no_photo.webp" />
    <meta property="og:title" content="<?=$rowPageContent['title']?> | UKRITARM" />

    <meta property="og:description" content="<? echo($soc_description);?>" />
    <meta name="description" content="<? echo($soc_description);?>">

    <meta name="author" content="">
    <meta name="keywords" content="<?=$rowPageContent['title']?> | UKRITARM" />
    <meta name="robots" content="all">
    <title><?=$title_google?></title>

    <?php include('includes/links.php');?>
    <link rel="stylesheet" href="assets/css/contact.min.css" />
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Info / Map -->
        <div class="contact_first">
            <!-- Info -->
            <div class="contact_first_info">
                <div class="contact_first_info_block">

                    <!-- Телефони -->
                    <div class="contact_first_info_block_item">
                        <h2 class="contact_first_info_block_item_phone" data-edit='contact_title'>
                            <?=$parsedData['contact_title']?>
                        </h2>

                        <a href="tel:<?=html_entity_decode($socialFooterContent['footer_contact_tel_1'])?>">
                            <?=html_entity_decode($socialFooterContent['footer_contact_tel_1'])?>
                        </a>
                        <a href="tel:<?=html_entity_decode($socialFooterContent['footer_contact_tel_2'])?>">
                            <?=html_entity_decode($socialFooterContent['footer_contact_tel_2'])?>
                        </a>
                        <a href="tel:<?=html_entity_decode($socialFooterContent['footer_contact_tel_3'])?>">
                            <?=html_entity_decode($socialFooterContent['footer_contact_tel_3'])?>
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="contact_first_info_block_item">
                        <h2 class="contact_first_info_block_item_mail" data-edit='email_title'>
                            <?=$parsedData['email_title']?>
                        </h2>

                        <a href="mailto: <?=$parsedData['email']?>" data-edit='email'>
                            <?=$parsedData['email']?>
                        </a>
                    </div>

                    <!-- Адреса -->
                    <div class="contact_first_info_block_item">
                        <h2 class="contact_first_info_block_item_location" data-edit='location_title'>
                            <?=$parsedData['location_title']?>
                        </h2>

                        <span data-edit='location'>
                            <?=$parsedData['location']?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="contact_first_map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10174.504596463074!2d30.852228362503585!3d50.392167358631724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4c523fa4398fb%3A0x4452ca9c47333931!2z0J7QntCeINCj0LrRgNC40YLQsNGA0Lw!5e0!3m2!1sen!2spl!4v1674462058602!5m2!1sen!2spl"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Розклад / Форма -->
        <div class="contact_second">
            <h3 data-edit='contact_second_title'>
                <?=$parsedData['contact_second_title']?>
            </h3>
            <div class="contact_second_row">
                <!-- Schedule -->
                <div class="contact_second_row_schedule">
                    <h4 data-edit='contact_second_when_work_title'>
                        <?=$parsedData['contact_second_when_work_title']?>
                    </h4>
                    <span class="contact_second_row_schedule_status">
                        <!-- Відчинено -->
                    </span>

                    <!-- Графік -->
                    <div class="contact_second_row_schedule_block">
                        <div class="contact_second_row_schedule_block_item">
                            <span>Понеділок</span>
                            <span id="mondayTime" data-edit='mondayTime'>
                                <?= $parsedData['mondayTime']?>
                            </span>
                        </div>
                        <div class="contact_second_row_schedule_block_item">
                            <span>Вівторок</span>
                            <span id="tuesdayTime" data-edit='tuesdayTime'>
                                <?= $parsedData['tuesdayTime']?>
                            </span>
                        </div>
                        <div class="contact_second_row_schedule_block_item">
                            <span>Середа</span>
                            <span id="wednesdayTime" data-edit='wednesdayTime'>
                                <?= $parsedData['wednesdayTime']?>
                            </span>
                        </div>
                        <div class="contact_second_row_schedule_block_item">
                            <span>Четвер</span>
                            <span id="thursdayTime" data-edit='thursdayTime'>
                                <?= $parsedData['thursdayTime']?>
                            </span>
                        </div>
                        <div class="contact_second_row_schedule_block_item">
                            <span>П’ятниця</span>
                            <span id="fridayTime" data-edit='fridayTime'>
                                <?= $parsedData['fridayTime']?>
                            </span>
                        </div>
                        <div class="contact_second_row_schedule_block_item">
                            <span>Субота</span>
                            <span id="saturdayTime" data-edit='saturdayTime'>
                                <?= $parsedData['saturdayTime']?>
                            </span>
                        </div>
                        <div class="contact_second_row_schedule_block_item">
                            <span>Неділя</span>
                            <span id="sundayTime" data-edit='sundayTime'>
                                <?= $parsedData['sundayTime']?>
                            </span>
                        </div>
                    </div>

                    <!-- Соц мережі -->
                    <div class="contact_second_row_schedule_social">
                        <h5 data-edit='contact_second_social_title'>
                            <?= $parsedData['contact_second_social_title']?>
                        </h5>
                        <div class="contact_second_row_schedule_social_row">
                            <!-- Facebook -->
                            <a href="<?= $facebook_link?>" target="_blank">
                                <span class="contact_second_row_schedule_social_row_fb"></span>
                            </a>
                            <!-- Youtube -->
                            <a href="<?= $youtube_link?>" target="_blank">
                                <span class="contact_second_row_schedule_social_row_youtube"></span>
                            </a>
                            <!-- Instagram -->
                            <a href="<?= $instagram_link?>" target="_blank">
                                <span class="contact_second_row_schedule_social_row_instagram"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <div class='contact_row_form'>
                    <!-- Success submit -->
                    <div id="contact_row_form_success" class="contact_row_form_success">
                        <div class="contact_row_form_success_block">
                            <span class="contact_row_form_success_block_title">
                                Повідомлення надіслано!
                            </span>
                        </div>
                    </div>

                    <!-- Contact form -->
                    <div id="contact_form" class='contact_row_form_block'>
                        <span class='contact_row_form_block_header' data-edit='contact_row_form_block_header'>
                            <?= $parsedData['contact_row_form_block_header']?>
                        </span>
                        <div class="contact_row_form_block_row">

                            <!-- Name -->
                            <div class='contact_row_form_block_item'>
                                <input id="userName" class="contact_row_form_block_item_input" type="text">

                                <label id="name_label" class='contact_row_form_block_item_label'>
                                    Iм'я
                                </label>

                                <span id="input_errorMessage1" class='contact_row_form_block_item_errorMessage'>
                                    Мiнiмум 2 символи
                                </span>
                            </div>

                            <!-- Email -->
                            <div class='contact_row_form_block_item'>
                                <input id="userEmail" class="contact_row_form_block_item_input" type="email">

                                <label id="email_label" class='contact_row_form_block_item_label'>
                                    Email
                                </label>

                                <span id="input_errorMessage2" class='contact_row_form_block_item_errorMessage'>
                                    Невiрний формат
                                </span>
                            </div>
                        </div>

                        <!-- Form textarea -->
                        <div class='contact_row_form_block_item'>
                            <textarea id="userMessage" class="contact_row_form_block_item_textarea" rows="1"></textarea>

                            <label id="review_label" class='contact_row_form_block_item_label'>
                                Повідомлення...
                            </label>
                            <span id="input_errorMessage3" class='contact_row_form_block_item_errorMessageTextArea'>
                                Обов'язкове поле. Мiнiмум 10 символiв.
                            </span>
                        </div>
                        <button id="contact_form_submit" class="contact_row_form_block_submit" type="button">
                            Надіслати
                            <!-- Loader -->
                            <div class="contact_row_form_block_submit_loader"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

    <script src="assets/js/contact.js"></script>
</body>

</html>