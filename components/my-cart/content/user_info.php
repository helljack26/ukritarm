<?
$last_name = isset($rowUserInfo['last_name']) ? $rowUserInfo['last_name'] : '';
$midle_name = isset($rowUserInfo['midle_name']) ? $rowUserInfo['midle_name'] : '';
$email = isset($rowUserInfo['email']) ? $rowUserInfo['email'] : '';
$contactno = isset($rowUserInfo['contactno']) ? $rowUserInfo['contactno'] : '';
?>


<!-- Форма фізичної особи -->
<div class="mycart_row_left_user">
    <h2>Контактні дані отримувача</h2>

    <!-- Switch buttons -->
    <div class="mycart_row_left_user_buttons">
        <button id="fiz" class="user_buttons_item user_buttons_item_active" type="button">
            Фізична особа
        </button>

        <button id="your" type="button" class="user_buttons_item">
            Юридична особа
        </button>
    </div>

    <!-- Fiz form -->
    <div id="fiz-osoba">
        <div class="mycart_row_left_user_item">

            <!-- 1 -->
            <div class="mycart_row_left_user_item_col">
                <!-- Fiz name -->
                <div class='form_col_item'>
                    <input type="text" id="fiz_name" class="form_col_item_input" value="<?=$name?>">
                    <label for="fiz_name" class='form_col_item_label'>Iм'я*</label>
                </div>

                <!-- Fiz last name -->
                <div class='form_col_item'>
                    <input type="text" id="fiz_lastname" class="form_col_item_input" value="<?=$last_name;?>">
                    <label for="fiz_lastname" class='form_col_item_label'>Прізвище*</label>
                </div>

                <!-- Fiz middle name -->
                <div class='form_col_item'>
                    <input type="text" id="fiz_midlname" class="form_col_item_input" value="<?=$midle_name;?>">
                    <label for="fiz_midlname" class='form_col_item_label'>По батькові</label>
                </div>
            </div>

            <!-- 2 -->
            <div class="mycart_row_left_user_item_col">
                <!-- Fiz email -->
                <div class='form_col_item'>
                    <input type="email" id="fiz_email" class="form_col_item_input email"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=$email;?>" />
                    <label for="fiz_email" class='form_col_item_label'>
                        Email*
                    </label>

                    <span id='error_email' class="error_email"></span>
                </div>

                <!-- Fiz phone -->
                <div class='form_col_item'>
                    <input type="tel" id="fiz_phone" class="form_col_item_input" value="<?= $contactno;?>"
                        placeholder="+38(___)_______*" maxlength="15">
                </div>
            </div>
        </div>
    </div>



    <!-- Yurydychni form -->
    <div id="yurydychna_osoba_tab">
        <div class="mycart_row_left_user_item">
            <!-- 1 -->
            <div class="mycart_row_left_user_item_col">
                <!-- Yurydychni code -->
                <div class='form_col_item'>
                    <input type="text" id="yurydychna_code" class="form_col_item_input">
                    <label for="yurydychna_code" class='form_col_item_label'>Код ЄДРПОУ*</label>
                </div>

                <!-- Yurydychni company -->
                <div class='form_col_item'>
                    <input type="text" id="yurydychna_company" class="form_col_item_input">
                    <label for="yurydychna_company" class='form_col_item_label'>Назва організації*</label>
                </div>

                <!-- Yurydychni email -->
                <div class='form_col_item'>
                    <input type="email" id='yurydychni_email' class="form_col_item_input yurydychni_email"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=$email;?>" />
                    <label for="yurydychni_email" class='form_col_item_label'>
                        Email*
                    </label>

                    <span id='error_yurydychni_email' class="error_email"></span>
                </div>
            </div>

            <!-- 2 -->
            <div class="mycart_row_left_user_item_col">
                <!-- Yurydychni phone -->
                <div class='form_col_item'>
                    <input type="tel" id="yurydychna_phone" class="form_col_item_input" value="<?= $contactno;?>"
                        placeholder="+38(___)_______*" maxlength="15">
                </div>
            </div>
        </div>
    </div>
</div>