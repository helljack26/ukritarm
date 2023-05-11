<?
$isEditFooter = $_SERVER['PHP_SELF'] === '/includes/footer.php';
if ($isEditFooter) {
    include('../includes/config.php');
    include('../function.php');
    echo('<link rel="stylesheet" href="../assets/css/style.min.css">');
}

$footerContent = getPageContent($con,'7');
?>

<footer id="footer">
    <div class="footer_container">
        <div class="footer_container_block">

            <!-- Про нас -->
            <div class="footer_container_block_aboutus">
                <h5 class="footer_container_block_aboutus_header" data-edit='footer_aboutus_header'>
                    <?= html_entity_decode($footerContent['footer_aboutus_header'])?>
                </h5>
                <p class="footer_container_block_aboutus_text" data-edit='footer_aboutus_text'>
                    <?= html_entity_decode($footerContent['footer_aboutus_text'])?>
                </p>
            </div>

            <!-- Навігація -->
            <nav class="footer_container_nav">
                <a href="/">Головна</a>
                <a href='all-category'>Продукція</a>
                <a href='services'>Послуги</a>
                <a href="aboutus">Про нас</a>
                <a href="contact">Контакти</a>
                <a href="news">Новини</a>
                <a href="information/oferta">Договір оферти</a>
                <a href="information/delivery">Доставка</a>
                <a href="information/payment">ОПЛАТА, ОБМІН ТА ПОВЕРНЕННЯ Укрітарм</a>
                <a href="information/personalDate">Обробка персональних даних</a>
            </nav>

            <!-- Наші контакти -->
            <div class="footer_container_block_contacts">
                <h5 class="footer_container_block_contacts_header" data-edit='footer_contact_header'>
                    <?= html_entity_decode($footerContent['footer_contact_header'])?>
                </h5>
                <a href="tel:<?= html_entity_decode($footerContent['footer_contact_tel_1'])?>"
                    data-edit='footer_contact_tel_1'>
                    <?= html_entity_decode($footerContent['footer_contact_tel_1'])?>
                </a>
                <a href="tel:<?= html_entity_decode($footerContent['footer_contact_tel_2'])?>"
                    data-edit='footer_contact_tel_2'>
                    <?= html_entity_decode($footerContent['footer_contact_tel_2'])?>
                </a>
                <a href="tel:<?= html_entity_decode($footerContent['footer_contact_tel_3'])?>"
                    data-edit='footer_contact_tel_3'>
                    <?= html_entity_decode($footerContent['footer_contact_tel_3'])?>
                </a>

                <!-- Соціальні мережі -->
                <div class="footer_container_block_contacts_social">
                    <!-- Facebook -->
                    <a href="<?= html_entity_decode($footerContent['footer_social_facebook'])?>" target="_blank">
                        <span class="footer_container_block_contacts_social_fb"></span>
                    </a>
                    <!-- Youtube -->
                    <a href="<?= html_entity_decode($footerContent['footer_social_youtube'])?>" target="_blank">
                        <span class="footer_container_block_contacts_social_youtube"></span>
                    </a>
                    <!-- Instagram -->
                    <a href="<?= html_entity_decode($footerContent['footer_social_instagram'])?>" target="_blank">
                        <span class="footer_container_block_contacts_social_instagram"></span>
                    </a>
                </div>

                <div class="footer_social_hidden">
                    <label>Посилання на Facebook</label>
                    <span data-edit='footer_social_facebook'>
                        <?= html_entity_decode($footerContent['footer_social_facebook'])?>
                    </span>
                    <label>Посилання на Youtube</label>
                    <span data-edit='footer_social_youtube'>
                        <?= html_entity_decode($footerContent['footer_social_youtube'])?>
                    </span>
                    <label>Посилання на Instagram</label>
                    <span data-edit='footer_social_instagram'>
                        <?= html_entity_decode($footerContent['footer_social_instagram'])?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer_container_copyright">
            <span data-edit='footer_copyright'>
                <?= html_entity_decode($footerContent['footer_copyright'])?>
            </span>

            <span class="footer_container_copyright_linkToOnix">
                Розроблено onixlab.com.ua
            </span>
        </div>
    </div>
</footer>

<? if (!$isEditFooter): ?>

<!-- Libs -->
<script type="text/javascript" src="assets/js/lib/echo.min.js"></script>
<script type="text/javascript" src="assets/js/lib/wow.min.js"></script>

<script type="module" src="assets/js/scripts.js"></script>

<? endif;?>