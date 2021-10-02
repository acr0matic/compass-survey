<?php require_once 'vendor/autoload.php';

// Путь к файлу ключа сервисного аккаунта
$googleAccountKeyFilePath = __DIR__ . '/php/access/compass-327321-1a60b351021a.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope('https://www.googleapis.com/auth/spreadsheets');

$service = new Google_Service_Sheets($client);
$spreadsheetId = '1SAcfuJRhrbe9duChY_1IyZxiU_KtHQjvhoJ3gGKqjVc';

$range = 'Главный лист!A2:B665';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <!-- Базовые мета-теги для поисковиков -->
  <title>Заголовок</title>

  <!-- Иконки для страницы -->
  <link rel="shortcut icon" href="img/favicons/favicon.ico" type="image/x-icon">
  <link rel="icon" sizes="16x16" href="img/favicons/favicon-16x16.png" type="image/png">
  <link rel="icon" sizes="32x32" href="img/favicons/favicon-32x32.png" type="image/png">
  <link rel="apple-touch-icon-precomposed" href="img/favicons/apple-touch-icon-precomposed.png">
  <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="167x167" href="img/favicons/apple-touch-icon-167x167.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon-180x180.png">
  <link rel="apple-touch-icon" sizes="1024x1024" href="img/favicons/apple-touch-icon-1024x1024.png">

  <!-- Метатеги которые выводят информацию о странице в поисковой запрос -->
  <meta name="description" content="описание не длиннее 155 символов" />
  <meta name="keywords" content="мета-теги, шаблон, html, css, acr0matic" />

  <!-- Метатеги для ссылок в социальных сетях -->
  <meta property="og:locale" content="ru_RU" />
  <meta property="og:title" content="">
  <meta property="og:description" content="" />
  <meta property="og:image" content="">

  <!-- Контролирует поведение поисковых систем при индексации страницы -->
  <meta name="robots" content="index,follow" />

  <!-- Покраска адресной строки в мобильных Chrome, Firefox OS и Opera -->
  <meta name="theme-color" content="#4285f4" />

  <!-- Покраска для iOS Safari -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="#4285f4">

  <!-- Место для счетков и аналитики -->

  <!-- Место для счетков и аналитики -->

  <!-- Стили -->
  <!-- build:css css/style.min.css -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- endbuild -->
</head>

<body>
  <!-- Шапка -->
  <header id="header">
    <div class="container-custom">
      <div class="header">
        <div class="header__burger">
          <img src="img/icons/misc/burger.svg" alt="">
        </div>
        <!-- /.header__burger -->

        <div class="header__logo">
          <a href=""><img src="img/logo.png" alt=""></a>
        </div>
        <!-- /.header__logo -->

        <nav class="header__nav nav nav--header">
          <ul class="nav__list">
            <li class="nav__item"><a class="nav__link link" href="">Пройти тест</a></li>
            <li class="nav__item"><a class="nav__link link" href="">Архетипы</a></li>
          </ul>
        </nav>
        <!-- /.nav -->
      </div>
      <!-- /.header -->
    </div>
    <!-- /.container-custom -->
  </header>

  <div id="mobile-menu" class="mobile-menu">
    <div class="mobile-menu__overlay"></div>

    <div class="mobile-menu__wrapper">
      <nav class="mobile-menu__nav nav nav--mobile">
        <ul class="nav__list">
          <li class="nav__item mb-3"><a href="" class="nav__link">Пройти тест</a></li>
          <li class="nav__item"><a href="" class="nav__link">Архетипы</a></li>
        </ul>
      </nav>
    </div>
    <!-- /.mobile-menu__wrapper -->
  </div>
  <!-- /.mobile-menu -->

  <!-- Основной контент -->
  <main>
    <section id="survey">
      <div class="container">
        <div class="survey">
          <div class="survey__slider position-relative">
            <div class="survey__header">
              <h1 class="survey__title">Тест на архетипы</h1>

              <div class="survey__progress survey-progress">
                <div class="survey-progress__title">Вопрос <span class="survey-progress__count">1/72</span></div>
                <div class="survey-progress__line">
                  <div class="survey-progress__fill"></div>
                  <div class="survey-progress__track"></div>
                </div>
                <!-- /.survey-progress__line -->
              </div>
              <!-- /.survey__progress survey-progress -->
            </div>
            <!-- /.survey__header -->

            <div class="swiper survey-slider">
              <?php
              $index = 0;
              $lenght = count($response);
              $slideCount = ceil($lenght / 16);
              ?>

              <div class="swiper-wrapper">

                <?php for ($i = 0; $i < $slideCount; $i++) { ?>
                  <div class="swiper-slide">
                    <div class="survey__page">
                      <?php do { ?>

                        <div class="survey__group" data-parameter="<?php echo $response[$index][1]; ?>">
                          <h2 class="survey__question"><?php echo $response[$index][0]; ?></h2>
                          <div class="survey__wrapper">
                            <div class="survey__item survey-item">
                              <span class="survey-item__text">Абсолютно <br> не согласен</span>
                              <img src="img/icons/rate/1.png" alt="" class="survey-item__icon">
                            </div>
                            <!-- /.survey__item survey-item -->

                            <div class="survey__item survey-item">
                              <span class="survey-item__text">Не согласен</span>
                              <img src="img/icons/rate/2.png" alt="" class="survey-item__icon">
                            </div>
                            <!-- /.survey__item survey-item -->

                            <div class="survey__item survey-item">
                              <span class="survey-item__text">Не знаю</span>
                              <img src="img/icons/rate/3.png" alt="" class="survey-item__icon">
                            </div>
                            <!-- /.survey__item survey-item -->

                            <div class="survey__item survey-item">
                              <span class="survey-item__text">Согласен</span>
                              <img src="img/icons/rate/4.png" alt="" class="survey-item__icon">
                            </div>
                            <!-- /.survey__item survey-item -->

                            <div class="survey__item survey-item">
                              <span class="survey-item__text">Полностью <br> согласен</span>
                              <img src="img/icons/rate/5.png" alt="" class="survey-item__icon">
                            </div>
                            <!-- /.survey__item survey-item -->
                          </div>
                          <!-- /.survey__wrapper -->
                        </div>
                        <!-- /.survey__group -->

                        <?php $index++ ?>
                      <?php } while (($index == 0 || $index % 16 != 0) && $index <= $lenght - 1) ?>
                    </div>
                    <!-- /.survey__page -->
                  </div>
                  <!-- /.swiper-slide -->
                  <?php  ?>
                <?php } ?>

              </div>
              <!-- /.swiper-wrapper -->
            </div>
            <!-- /.swiper survey-slider  -->

            <div class="swiper__control">
              <div class="swiper-button-prev survey-slider__prev button button--small button-primary">Назад</div>
              <div class="swiper-button-next survey-slider__next button button--small button-primary">Далее</div>
            </div>
            <!-- /.swiper__control -->
          </div>
          <!-- /.survey__slider -->

          <form action="php/mail.php" class="survey__form form form-survey">
            <div class="form__title">Получить результаты</div>

            <div class="survey__wrapper">
              <div class="form__wrapper">
                <div class="form__row">
                  <div class="row align-items-center">
                    <div class="col-12 col-md-3 mb-3 mb-lg-0">
                      <label class="input">
                        <span class="input__placeholder me-2">Имя</span>
                        <input data-required placeholder="Иван" autocomplete="off" type="" name="user_name" class="input__field">
                        <img data-tippy-content="Номер телефона не указано или указано не верно" class="input__warning" src="img/icons/misc/warning.svg" alt="">
                      </label>
                      <!-- /.input -->
                    </div>
                    <!-- /.col-4 -->

                    <div class="col-12 col-md-4 mb-3 mb-lg-0">
                      <label class="input">
                        <span class="input__placeholder me-2">Email</span>
                        <input data-required placeholder="ivan@email.com" autocomplete="off" type="" name="user_email" class="input__field">
                        <img data-tippy-content="Номер телефона не указан или указан не верно" class="input__warning" src="img/icons/misc/warning.svg" alt="">
                      </label>
                      <!-- /.input -->
                    </div>
                    <!-- /.col-4 -->

                    <div class="col-12 col-md-3 ps-xxl-5 mb-3 mb-lg-0">
                      <div class="input">
                        <span class="input__placeholder me-4">Пол</span>
                        <label class="input__label me-4 mt-1">
                          <input checked placeholder="" autocomplete="off" type="radio" value="Мужчина" name="user_gender" class="input__radio radio">
                          <span class="ms-2">М</span>
                        </label>

                        <label class="input__label mt-1">
                          <input placeholder="" autocomplete="off" type="radio" value="Женщина" name="user_gender" class="input__radio radio">
                          <span class="ms-2">Ж</span>
                        </label>

                        <img data-tippy-content="" class="input__warning" src="" alt="">
                      </div>
                      <!-- /.input -->
                    </div>
                    <!-- /.col-3 -->

                    <div class="col-12 col-md-2">
                      <label class="input">
                        <span class="input__placeholder me-2">Возраст</span>
                        <input data-required placeholder="24" autocomplete="off" type="number" min="0" max="99" name="user_age" class="input__field">
                        <img data-tippy-content="Возраст не указан или указан не верно" class="input__warning" src="img/icons/misc/warning.svg" alt="">
                      </label>
                      <!-- /.input -->
                    </div>
                    <!-- /.col-2 -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.form__row -->

                <label class="checkbox mt-3 mt-xxl-5 ms-4">
                  <input name="user_subscribe" type="checkbox">
                  <span class="checkbox__mark"></span>
                  <span class="checkbox__label">Получать письма с полезной информацией и новостями</span>
                </label>

                <p class="form__error">Вы ответили не на все вопросы! Пожалуйста, проверьте еще раз свои ответы.</p>

                <button type="submit" data-sending="Отправка..." class="form__button button button-primary mx-auto mb-4">Результат</button>
                <p class="form__privacy">Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь c <a class="form__link link" href="">политикой конфиденциальности</a></p>
              </div>
              <!-- /.survey-form__wrapper -->
            </div>
            <!-- /.survey__wrapper -->
          </form>
          <!-- /.survey__form form survey-form -->

          <div id="map" class="survey__result survey-result">
            <div class="survey-result__wrapper">
              <div class="survey-result__map">
                <img src="img/map/map.jpg" alt="" class="survey-result__image">

                <div class="survey-result__group survey-result__group--top">
                  <div data-parameter="Герой" class="survey-result__parameter me-5">
                    <span class="survey-result__title">Герой</span>
                    <img src="img/map/Герой.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Маг" class="survey-result__parameter me-5">
                    <span class="survey-result__title">Маг</span>
                    <img src="img/map/Маг.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Бунтарь" class="survey-result__parameter">
                    <span class="survey-result__title">Бунтарь</span>
                    <img src="img/map/Бунтарь.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->
                </div>
                <!-- /.survey-result__group -->

                <div class="survey-result__group survey-result__group--right">
                  <div data-parameter="Простодушный" class="survey-result__parameter mb-5">
                    <span class="survey-result__title">Простодушный</span>
                    <img src="img/map/Простодушный.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Мудрец" class="survey-result__parameter mb-5">
                    <span class="survey-result__title">Мудрец</span>
                    <img src="img/map/Мудрец.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Искатель" class="survey-result__parameter">
                    <span class="survey-result__title">Искатель</span>
                    <img src="img/map/Искатель.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->
                </div>
                <!-- /.survey-result__group -->

                <div class="survey-result__group survey-result__group--bottom">
                  <div data-parameter="Заботливый" class="survey-result__parameter me-5">
                    <span class="survey-result__title">Заботливый</span>
                    <img src="img/map/Заботливый.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Правитель" class="survey-result__parameter me-5">
                    <span class="survey-result__title">Правитель</span>
                    <img src="img/map/Правитель.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Творец" class="survey-result__parameter">
                    <span class="survey-result__title">Творец</span>
                    <img src="img/map/Творец.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->
                </div>
                <!-- /.survey-result__group -->

                <div class="survey-result__group survey-result__group--left">
                  <div data-parameter="Славный малый" class="survey-result__parameter mb-5">
                    <span class="survey-result__title">Славный малый</span>
                    <img src="img/map/Славный малый.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Шут" class="survey-result__parameter mb-5">
                    <span class="survey-result__title">Шут</span>
                    <img src="img/map/Шут.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->

                  <div data-parameter="Любовник" class="survey-result__parameter">
                    <span class="survey-result__title">Любовник</span>
                    <img src="img/map/Любовник.png" alt="" class="survey-result__icon">
                    <span class="survey-result__percentage">0</span>
                  </div>
                  <!-- /.survey-result__parameter -->
                </div>
                <!-- /.survey-result__group -->
              </div>
              <!-- /.survey-result__map -->
            </div>
            <!-- /.survey-result__wrapper -->

            <div class="survey-result__action">
              <div class="survey-result__info">
                <span class="low mb-2">0-60 % - слабо выраженный</span>
                <span class="medium mb-2">61-80 % - выраженный</span>
                <span class="high ">81-100 % - ведущий</span>
              </div>
              <!-- /.survey-result__info -->

              <div class="survey-result__buttons">
                <button class="button button-primary mt-3 mt-lg-0 mb-3 mb-lg-0 me-lg-4">Сохранить результат</button>
                <button class="button button-secondary">Узнать подробнее</button>
              </div>
              <!-- /.survey-result__buttons -->
            </div>
            <!-- /.survey-result__action -->
          </div>
          <!-- /.survay__result survey-result -->
        </div>
        <!-- /.survey -->
      </div>
      <!-- /.container -->
    </section>
  </main>

  <!-- Подвал -->
  <footer id="footer">
    <div class="container">
      <div class="footer">
        <div class="footer__social">
          <a href="" class="me-1 me-lg-3 link">
            <img class="footer__icon " src="img/social/instagram.png" alt="">
          </a>

          <a href="" class="me-1 me-lg-3 link">
            <img class="footer__icon " src="img/social/vk.png" alt="">
          </a>

          <a href="" class="me-1 me-lg-3 link">
            <img class="footer__icon " src="img/social/telegram.png" alt="">
          </a>

          <a href="" class="me-1 me-lg-3 link">
            <img class="footer__icon " src="img/social/facebook.png" alt="">
          </a>

          <a href="" class="link">
            <img class="footer__icon " src="img/social/tiktok.png" alt="">
          </a>
        </div>
        <!-- /.footer__social -->

        <div class="footer__info">
          <span class="mb-2">По всем вопросам</span>
          <a href="mailto:projectkompas999@gmail.com" class="footer__link link">projectkompas999@gmail.com</a>
        </div>
        <!-- /.footer__info -->
      </div>
      <!-- /.footer -->
    </div>
    <!-- /.container -->
  </footer>

  <!-- Скрипты -->
  <!-- build:js js/script.min.js -->
  <script src="scripts/libraries/lazyload.js"></script>
  <script src="scripts/libraries/lodash.js"></script>
  <script src="scripts/libraries/swiper.min.js"></script>
  <script src="scripts/libraries/html2canvas.min.js"></script>
  <script src="scripts/libraries/circletype.min.js"></script>
  <script src="scripts/libraries/popper.js"></script>
  <script src="scripts/libraries/tippy.js"></script>
  <script src="scripts/libraries/formController.js"></script>

  <script src="scripts/main.js"></script>
  <script src="scripts/survey.js"></script>
  <script src="scripts/map.js"></script>
  <script src="scripts/header.js"></script>
  <!-- endbuild -->
</body>

</html>