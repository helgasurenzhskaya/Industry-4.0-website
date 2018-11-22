<?php

use Phinx\Migration\AbstractMigration;

class Init extends AbstractMigration
{
    public function change()
    {
        $menus = $this->table('menus');
        $menus->addColumn('title_uk', 'string');
        $menus->addColumn('title_en', 'string');
        $menus->addColumn('url_uk', 'string');
        $menus->addColumn('url_en', 'string');
        $menus->addColumn('sort', 'integer', ['default' => 100]);

        $menus->insert([
            [
                'title_uk' => 'Головна',
                'title_en' => 'Home',
                'url_uk' => '\uk',
                'url_en' => '\en',
                'sort' => 10,
            ],
            [
                'title_uk' => 'Інформація',
                'title_en' => 'About',
                'url_uk' => '\uk#about',
                'url_en' => '\en#about',
                'sort' => 30,
            ],
            [
                'title_uk' => 'Напрямки',
                'title_en' => 'Directions',
                'url_uk' => '\uk#direction',
                'url_en' => '\en#direction',
                'sort' => 50,
            ],
        ]);
        
        $menus->create();

        $pages = $this->table('pages');
        $pages->addColumn('name', 'string');
        $pages->addColumn('text_uk', 'text');
        $pages->addColumn('text_en', 'text');
        $pages->addColumn('sort', 'integer', ['default' => 100]);

        $pages->insert([
            [
                'name' => 'Industry 4.0',
                // 'image' => '',
                'text_uk' => '
                <div class="main">
                <video autoplay playsinline muted loop preload poster="#">
                    <source src="content/video.mp4" type="video/mp4">
                    <source src="content/video.webm" type="video/webm">
                </video>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 285 80" preserveAspectRatio="xMidYMid slice">
                    <defs>
                        <mask id="mask" x="0" y="0" width="100%" height="100%" >
                            <rect x="0" y="0" width="100%" height="100%" />
                            <text x="50%" y="35%" dominant-baseline="middle" alignment-baseline="middle" text-anchor="middle">IN4.0</text>
                        </mask>
                    </defs>
                    <rect x="0" y="0" width="100%" height="100%" />
                </svg>
            </div>
                <section class="hero">
                    <div class="hero-content">
                        <h3>Четверта технічна революція</h3>
                    </div>
                    <a class="container-arrow scroll-to" >
                        <span>
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </a>
                </section>
                ',

                'text_en' => '
                <div class="main">
                    <video autoplay playsinline muted loop preload poster="#">
                        <source src="content/video.mp4" type="video/mp4">
                        <source src="content/video.webm" type="video/webm">
                    </video>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 285 80" preserveAspectRatio="xMidYMid slice">
                        <defs>
                            <mask id="mask" x="0" y="0" width="100%" height="100%" >
                                <rect x="0" y="0" width="100%" height="100%" />
                                <text x="50%" y="35%" dominant-baseline="middle" alignment-baseline="middle" text-anchor="middle">IN4.0</text>
                            </mask>
                        </defs>
                        <rect x="0" y="0" width="100%" height="100%" />
                    </svg>
                </div>
                <section class="hero">
                    <div class="hero-content">
                        <h3>the fourth technical revolution</h3>
                    </div>
                    <a class="container-arrow scroll-to" >
                    <span>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>  </span>
                    </a>
                </section>
                '
            ],
            [
                'name' => 'Industry 4.0',
                'text_uk' => '
                <section id="about" class="section" >
                    <h2 class="atitle">Що це?</h2>
                    <p>Індустрія 4.0 - це технічна революція, яка уособлює в собі автоматизацію виробництва, поширення Інтернету речей, аналізу та обробки великих даних, використання нейромереж та створення штучного інтелекту. Метою цієї революції є об’єднання усіх технологій в одну саморегульовану систему, що стирає межі фізичних, цифрових та біологічних сфер.</p>
                    <hr>
                </section>
                ',

                'text_en' => '
                <section id="about" class="section" >
                    <h2 class="atitle">What is it?</h2>
                    <p>Industry 4.0 is a technical revolution that embodies automation of production,
                        the dissemination of Internet of things, analysis and processing of Big data,
                        the use of neural networks and the creation of artificial intelligence.
                        The purpose of this revolution is to unite all technologies into one self-regulating
                        system that erases the boundaries of physical, digital and biological spheres.
                    </p>
                    <hr>
                </section>
                '
            ],     
            [
                'name' => 'Індустрія 4.0',
                'text_uk' => '
                <section class="history">
            <div class="timeline-container" id="timeline-1">
                <div class="timeline-header">
                    <h2 class="timeline-header__title">ІСТОРІЯ</h2>
                </div>
                <div class="timeline">
                    <div class="timeline-item" data-text="ІНДУСТРІЯ 1.0">
                        <div class="timeline__content">
                        <img class="timeline__img" src="content/phototimeline1.jpg"/>
                        <h2 class="timeline__content-title">18-ТЕ СТОЛІТТЯ</h2>
                        <p class="timeline__content-desc">Було покладено нові наукові основи математики, астрономії, механіки та медицини. Почалося будівництво і відкриття залізниць. Винахід парової машини зумовив масштабний розвиток промислового виробництва.</p>
                        </div>
                    </div>
                    <div class="timeline-item" data-text="ІНДУСТРІЯ 2.0">
                        <div class="timeline__content">
                        <img class="timeline__img" src="content/phototimeline2.jpg"/>
                        <h2 class="timeline__content-title">20-ТЕ СТОЛІТТЯ</h2>
                        <p class="timeline__content-desc">Друга технічна революція відома винайденням електродвигуна, телефону, літака, переходом до використання нафти, запуском масового виробництва автомобілів, поширенням конвеєрів і двигунів внутрішнього згоряння.</p>
                        </div>
                    </div>
                    <div class="timeline-item" data-text="ІНДУСТРІЯ 3.0">
                        <div class="timeline__content">
                        <img class="timeline__img" src="content/phototimeline3.jpg"/>
                        <h2 class="timeline__content-title">1970-ТІ</h2>
                        <p class="timeline__content-desc">Третя промислова революція характеризується появою ядерної енергії, створенням комп’ютерів, відкриттями в області біотехнологій. Ця революція породила епоху високого рівня автоматизації виробництва.</p>
                        </div>
                    </div>
                    <div class="timeline-item" data-text="ІНДУСТРІЯ 4.0">
                        <div class="timeline__content">
                        <img class="timeline__img" src="content/phototimeline4.jpg"/>
                        <h2 class="timeline__content-title">СЬОГОДЕННЯ</h2>
                        <p class="timeline__content-desc">Початок використання нейромереж і 3D-Друку, винайдення квантових комп’ютерів і впровадження робототехніки у повсякденне життя.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>',

                'text_en' => '
                <section class="history">
                    <div class="timeline-container" id="timeline-1">
                        <div class="timeline-header">
                            <h2 class="timeline-header__title">HISTORY</h2>
                        </div>
                        <div class="timeline">
                            <div class="timeline-item" data-text="INDUSTRY 1.0">
                                <div class="timeline__content">
                                <img class="timeline__img" src="content/phototimeline1.jpg"/>
                                <h2 class="timeline__content-title">18TH CENTURY</h2>
                                <p class="timeline__content-desc">New scientific foundations of mathematics, astronomy, mechanics and medicine were laid. Construction and opening of railways began. The invention of the steam engine led to the large-scale development of industrial production.</p>
                                </div>
                            </div>
                            <div class="timeline-item" data-text="INDUSTRY 2.0">
                                <div class="timeline__content">
                                <img class="timeline__img" src="content/phototimeline2.jpg"/>
                                <h2 class="timeline__content-title">20TH CENTURY</h2>
                                <p class="timeline__content-desc">The second technological revolution is known by the invention of the electric motor, telephone, aircraft, the transition to the use of oil, the launch mass production of cars, the spread of conveyors and internal combustion engines.</p>
                                </div>
                            </div>
                            <div class="timeline-item" data-text="INDUSTRY 3.0">
                                <div class="timeline__content">
                                <img class="timeline__img" src="content/phototimeline3.jpg"/>
                                <h2 class="timeline__content-title">1970S</h2>
                                <p class="timeline__content-desc">The third industrial revolution is characterized by the emergence of nuclear energy, the creation of computers, discoveries in the field of biotechnology. This revolution has caused an era of high-level automation of production.</p>
                                </div>
                            </div>
                            <div class="timeline-item" data-text="INDUSTRY 4.0">
                                <div class="timeline__content">
                                <img class="timeline__img" src="content/phototimeline4.jpg"/>
                                <h2 class="timeline__content-title">TODAY</h2>
                                <p class="timeline__content-desc">The start of using neural networks and 3D Printing, inventing of quantum computers and implementing of robotics in our everyday life.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
        ]);    
    
        $pages->create();
    }
}
