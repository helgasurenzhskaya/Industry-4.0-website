<?php

use Phinx\Migration\AbstractMigration;

class Articles extends AbstractMigration
{
    public function change()
    {
        $security = new Phalcon\Security();

        $users = $this->table('users');
        $users->addColumn('login', 'string', ['limit' => 32]);
        $users->addColumn('name', 'string', ['limit' => 32]);
        $users->addColumn('password', 'string', ['limit' => 64]);
        $users->addColumn('active', 'integer', ['default' => 1]);
        $users->addColumn('role', 'enum', ['values' => ['admin', 'editor']]);
        $users->addIndex('login', ['unique' => true]);

        $olgaId = 1;
        $users->insert([
            'id' => $olgaId,
            'login' => 'olgafereal',
            'name' => 'Olga',
            'password' => $security->hash('123456'),
            'role' => 'admin',
        ]);

        $users->create();

        $articles = $this->table('articles');
        $articles->addColumn('author_id', 'integer');
        $articles->addColumn('title_uk', 'string');
        $articles->addColumn('title_en', 'string');
        $articles->addColumn('image', 'string', ['null' => true]);
        $articles->addColumn('text_uk', 'text');
        $articles->addColumn('text_en', 'text');
        $articles->addColumn('sort', 'integer', ['default' => 100]);
        $articles->addForeignKey('author_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);

        $articles->insert([
            [
            'author_id' => $olgaId,
            'title_uk' => 'Кіберфізичні системи',
            'title_en' => 'Cyber-physical systems',
            'image' => '1.jpg',
            'text_uk' => '
            <style>
            body {
                background: url("content/article/1.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }

               

                ul {
                  margin-top: 5%;
                }


                header {
                  width: 100%;
                  margin: 0 auto;
                  position: relative;
                justify-content: space-between;
                    align-items: center;
                   background-color: white;
                   opacity: 1;
                   height: 12vw;
                }

                .link {
                  display: inline-block;
                  float: right;
                }
                
                  
              </style>
              <div class="act"></div>
              <h1>Кіберфізичні системи</h1>
            <div class="wrapper">
                <div class="content-wrapper">
                    <span class="first-character">Н</span>
                    <p>
                        а сучасному етапі розвитку промисловості інформаційні технології стають невід’ємною частиною системи автоматизації виробництва. Промислова автоматизація має свою історію застосування комерційних технологій, коли вони стають широко доступними. Наприклад, планшетні комп’ютери з Wi-Fi тепер широко використовують для поліпшення роботи та ефективності обслуговування.
                    </p>
                    <p>
                        Подальше поєднання інформаційних та виробничих технологій створює потенціал, здатний дійсно змінити ланцюг від виробництва через постачальників до клієнтів на кожному етапі їх взаємодії.
                    </p>
                    <p>
                        Упродовж останніх кількох років спостерігається підвищена активність в сфері створення кіберфізичних систем, поєднань фізичних та кібернетичних компонентів, які забезпечують організацію вимірювально-обчислювальних процесів, захищене зберігання службової інформації.
                    </p>
                    <div class="image-left">
                        <img src="./content/article/cs1.jpg" />
                        <p>
                            Спираючись на концепцію кіберфізичних систем, провідні наукові установи та групи в усьому світі спрямовують свої зусилля на пошук нових напрямів розвитку інформаційно-обчислювальних технологій об’єднанням та інтегруванням різних за призначенням підсистем у єдину децентралізовану та гнучку систему.
                        </p>
                    </div>
                    <p>
                        Інтеграція фізичних процесів та обчислень не є чимось новим. Для опису таких систем давно використовують термін “вбудовані системи”. Серед успішних їх застосувань – системи зв’язку, домашня автоматика, озброєння, повітряний та наземний транспорт тощо. До перших розробок цього напряму належать створені нами вбудовані процесори та комп’ютерні системи, впроваджені в технічних комплексах як цивільного, так і військового призначення. Зокрема, це розробка та впровадження низки процесорів спектрального аналізу радіолокаційних сигналів, розробка та впровадження ряду програмованих процесорів цифрового опрацювання сигналів, створення широкого спектра спеціалізованих процесорів багатовимірного спектрального аналізу сигналів та зображень, шифрування та кодування інформації, тощо.
                    </p>
                    <p>
                        Ще одним ключовим елементом, що вплинув на формування концепції кіберфізичних систем, є сучасні засоби телекомунікацій. Сьогодні ці засоби забезпечують взаємодію компонентів системи практично довільного розміщення з використанням як дротового, так і бездротового зв’язку.
                    </p>
                </div>
            </div> ',

            'text_en' => '
            <style>
            body {
                background: url("content/article/1.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }

               

                  ul {
                    margin-top: 5%;
                  }


                  header {
                    width: 100%;
                    margin: 0 auto;
                    position: relative;
                  justify-content: space-between;
                      align-items: center;
                     background-color: white;
                     opacity: 1;
                     height: 12vw;
                  }

                  .link {
                    display: inline-block;
                    float: right;
                  }
                  
              </style>
              <div class="act"></div>
              <h1>Cyber-physical systems</h1>
            <div class="wrapper">
                <div class="content-wrapper">
                    <span class="first-character">A</span>
                    <p>
                        t the present stage of the development of industry, information technology becomes an integral part of the automation system of production. Industrial automation has its own history of commercial technology when it becomes widely available. For example, tablet PCs with Wi-Fi are now widely used to improve performance and serviceability.
                    </p>
                    <p>
                        The further combination of information and production technology creates the potential that can really change the chain from production through suppliers to customers at each stage of their interaction.
                    </p>
                    <p>
                        Over the past few years, there has been increased activity in the field of the creation of cyber-physics systems, combinations of physical and cybernetic components that provide the organization of measurement and computing processes, and protect the storage of official information.
                    </p>
                    <div class="image-left">
                        <img src="./content/article/cs1.jpg" />
                        <p>
                            Cyber-physical systems are physical and engineered systems whose operations are monitored, coordinated, controlled and integrated by a computing and communication core. Just as the internet transformed how humans interact with one another, cyber-physical systems will transform how we interact with the physical world around us.
                        </p>
                    </div>
                    <p>
                        Building on the concept of cyber-physics systems, leading research institutions and groups around the world are focusing their efforts on finding new areas for the development of information and computing technologies by integrating and integrating different subsystems into a single, decentralized and flexible system.
                    </p>
                    <p>
                        Integration of physical processes and computing is not something new. The term "embedded systems" has long been used to describe such systems. Among their successful applications are communication systems, home automation, armaments, air and land transport, and so on. The first developments in this area include built-in built-in processors and computer systems implemented in technical systems for both civilian and military purposes. In particular, it is the development and implementation of a number of spectrum analysis processors for radar signals, the development and implementation of a number of programmable processors for digital signal processing, the creation of a wide range of specialized processors for multimodal spectral analysis of signals and images, encryption and encoding of information, etc.
                    </p>
                    <p>
                        In the manufacturing environment, CPSs can improve processes by sharing real-time information among the industrial machines, manufacturing supply chain, suppliers, business systems, and customers. Also, CPSs can improve these processes by self-monitoring and controlling the entire production processes and then adapting production to satisfy customers\' preferences. CPSs provide a higher degree of visibility and control on supply chains, improving the traceability and security of goods.
                    </p>
                    <p>
                        In the healthcare environment, CPSs are used for real-time and remote monitoring of the physical conditions of patients to limit patient hospitalization (for example, for patients who suffer from Alzheimer\'s disease) or to improve treatments for disabled and elderly patients. Moreover, CPSs are used in research in the neuroscience field to better understand human functions with the support of brain-machine interfaces and therapeutic robotics.
                    </p>
                    <div class="image-right">
                        <img src="./content/article/cs2.jpg" />
                        <p>
                            Another key element that influenced the formation of the concept of cyber-physics systems is the modern telecommunication facilities. Today, these tools provide the interaction of components of the system of virtually arbitrary placement using both wire and wireless communication.
                        </p>
                    </div>
                    <p>
                        In the renewable energy environment, smart grids are CPSs where sensors and other devices monitor the grid to control it and provide better reliability and improve the energy efficiency.
                    </p>
                    <p>
                        In smart building environments, smart devices and CPSs interact to reduce energy consumption, to increase safety and security, and to improve inhabitants comfort. For example, with CPSs you can enable energy monitoring and control systems usage, which help you achieve zero-energy buildings, or you can determine the extent of damage that buildings suffer after unexpected events and help prevent structural failures.
                    </p>
                    <p>
                        In the transportation environment, individual vehicles and the infrastructure can communicate with each other, sharing real-time information about traffic, location, or issues, in order to prevent accidents or congestion, improve safety, and ultimately save money and time.
                    </p>
                    <p>
                        In the agriculture environment, CPSs can be used to create more modern and precise agriculture. CPSs can collect fundamental information about the climate, the ground, and other data, in order to realize more accurate systems of agricultural management. CPSs can constantly monitor different resources, such as watering, humidity, plant health and others, through sensors and, thus, keep the ideal environmental values.
                    </p>
                    <p>
                        In computer networks, CPSs can boost cyber environments to better understand systems and users\' behaviors, which can help improve performances and resource management. For example, applications can be optimized to work in relation to the contexts and to the users\' actions, or to monitor available resources. Moreover, popular social networks and e-commerce websites store users\' navigation information and users\' web content, analyzes that information, and then tries to predict interests and make recommendation for friends, posts, links, pages, events, or products.
                    </p>
                </div>
            </div>

           ',
            ],
            [
                'author_id' => $olgaId,
                'title_uk' => 'Аналіз великих даних',
                'title_en' => 'Big data analysis',
                'image' => '2.jpg',
                'text_uk' => '
                <style>
            body {
                background: url("content/article/2.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }

                

                ul {
                  margin-top: 5%;
                }


                header {
                  width: 100%;
                  margin: 0 auto;
                  position: relative;
                justify-content: space-between;
                    align-items: center;
                   background-color: white;
                   opacity: 1;
                   height: 12vw;
                }

                .link {
                  display: inline-block;
                  float: right;
                }
                
              </style>
              <div class="act"></div>
              <h1>Великі дані</h1>
                <div class="wrapper">
                    <div class="content-wrapper">
                        <span class="first-character">В</span>
                        <p>
                            еликі дані стали модним словом у бізнесі, а їхні можливі переваги та підводні камені отримують все більшу увагу з боку засобів масової інформації в усьому світі. Переважна кількість даних, що збираються, зберігаються і передаються через нові технології, перебудовують пріоритети для багатьох підприємств, і розробка нових аналітичних інструментів підлаштовується під інші глибокі зрушення у тому, як компанії працюють заради трансформації бізнесу.
                        </p>
                        <p>
                            Великі дані - це сукупність технологій, які покликані  обробляти великі в порівнянні з «стандартними» сценаріями обсяги даних, вміти працювати з даними, що швидко поступають в дуже великих обсягах, повинні вміти працювати зі структурованими і погано структурованими даними паралельно в різних аспектах.
                        </p>
                        <div class="image-left">
                        <img src="./content/article/bd1.jpg" />
                            <p>
                                Найцікавіше, що Big Data вже багато років формує наш щоденний спосіб життя і впливає на наші вчинки та рішення.
                            </p>
                        </div>
                        <p>
                            Великі дані - це спосіб обробки величезних і різноманітних масивів інформації, які надходять щосекунди. Такі дані важливо швидко обробити і  структурувати для того, щоб в майбутньому отримати щось корисне з них. Як ми стикаємося з Big Data кожен день? Людина - головний генератор і споживач великих даних. Щодня ми створюємо стільки нової інформації, скільки раніше створювали десятиліттями. Ми генеруємо інформацію не тільки за допомогою фотографій і соціальних постів. Це кожен наш пошуковий запит, крок, порахований фітнес-трекером, відео, переглянуте на YouTube. Майже кожна наша дія кимось записується і стає частиною Big Data.
                        </p>
                        <p>
                            Тільки в Google відбувається близько 40 000 пошукових запитів щомиті, що дає близько 1,2 трильйона пошукових запитів для великих даних щорічно. І з кожним днем кількість даних збільшується все швидше. Якщо сьогодні ми генеруємо 4,4 зетабайта даних, то до 2020 ми будемо створювати вже 44. До 2020 року майже третина всіх даних буде проходити через хмарні сервіси, а значить буде піддана аналізу.
                        </p>
                        <div class="image-right">
                        <img src="./content/article/bd2.jpg"/>
                            <p>
                                Цікаво, що для аналізу великих даних не завжди використовуються комп\'ютери корпорацій.
                            </p>
                        </div>
                        <p>
                            Часто користувачі самі надають свої комп\'ютери для вирішення різних наукових завдань. В цей же час 73% організацій проінвестували або збираються проінвестувати в розвиток великих даних. Великі компанії типу Google, Facebook і навіть держави обробляють і використовують цю інформацію для поліпшення нашого способу життя. Ну, або для показу більш релевантної реклами.
                        </p>
                        <p>
                            На основі цих даних ми можемо не тільки отримувати таргетовану рекламу, орієнтовану тільки на нас, але і значно поліпшити наше життя.  Сьогодні обробці піддається лише 0,5% усіх доступних даних. Тому найцікавіше все ще в майбутньому.
                        </p>
                    </div>
                </div>

            ',
                'text_en' => '
                <style>
            body {
                background: url("content/article/2.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }


                ul {
                  margin-top: 5%;
                }


                header {
                  width: 100%;
                  margin: 0 auto;
                  position: relative;
                justify-content: space-between;
                    align-items: center;
                   background-color: white;
                   opacity: 1;
                   height: 12vw;
                }

                .link {
                  display: inline-block;
                  float: right;
                }
                
              </style>
              <div class="act"></div>
              <h1>Big Data</h1>
                <div class="wrapper">
                    <div class="content-wrapper">
                        <span class="first-character">B</span> <p>ig Data has become a trendy word in business, and their potential benefits and pitfalls are getting more and more attention from business and media around the world. The vast majority of collected data is stored and transmitted through new technologies, rebuilding priorities for many enterprises, and the development of new analytical tools adapts to other profound shifts in how companies work for the sake of business transformation. </p>
                        <p>
                        Large data is a collection of technologies designed to process large volumes of data in comparison with "standard" scenarios, to be able to work with data that is rapidly arriving at very large volumes, should be able to work with structured and poorly structured data in parallel in various aspects .
                        </p>
                        <div class="image-left">
                            <img src="./content/article/bd1.jpg" />
                            <p>
                                Most interestingly, Big Data has been shaping our daily lives for many years and influencing our actions and solutions.
                            </p>
                        </div>
                        <p>
                            Larger data is a way of processing huge and varied arrays of information coming in every second. It\'s important to quickly process and structure these data in order to get something useful from the future. How do we deal with Big Data every day? Man is the main generator and consumer of large data. Every day we create so much new information as we\'ve been creating for decades. We generate information not only through photographs and social posts. This is our every search query, a step calculated by the fitness tracker, a video viewed on YouTube. Almost every one of our actions is written to somebody and becomes part of Big Data.
                        </p>
                        <p>
                            Google only has about 40,000 searches every second, giving about 1.2 trillion searches for large data annually. And every day, the amount of data increases faster. If today we generate 4.4 zebaytes of data, then by 2020 we will create 44. By 2020, almost a third of all data will pass through cloud services, and hence will be analyzed.
                        </p>
                        <div class="image-right">
                            <img src="./content/article/bd2.jpg"/>
                            <p>
                                Interestingly, for the analysis of large data, computers are not always used by corporations.
                            </p>
                        </div>
                        <p>
                            Often, users themselves provide their computers for solving various scientific problems. At the same time, 73% of organizations have been or are about to invest in the development of large data. Large companies like Google, Facebook, and even governments handle and use this information to improve our lifestyle. Well, either to show more relevant ads.
                        </p>
                        <p>
                            Based on this data, we can not only receive targeting ads that are targeted only to us but also significantly improve our lives. Today only 0.5% of all available data is processed. Therefore, the most interesting is still in the future.
                        </p>
                    </div>
                </div>',
            ],

            [
                'author_id' => $olgaId,
                'title_uk' => 'Інтернет речей',
                'title_en' => 'Internet of things',
                'image' => '3.jpg',
                'text_uk' => '
                <div class="wrapper">
                <style>
            body {
                background: url("content/article/3.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }


                ul {
                  margin-top: 5%;
                }


                header {
                  width: 100%;
                  margin: 0 auto;
                  position: relative;
                justify-content: space-between;
                    align-items: center;
                   background-color: white;
                   opacity: 1;
                   height: 12vw;
                }

                .link {
                  display: inline-block;
                  float: right;
                }
                
              </style>
              <div class="act"></div>
              <h1>Інтернет речей</h1>
                    <div class="content-wrapper">
                        <span class="first-character">С</span>
                        <p>
                            учасна концепція Інтернету речей передбачає комунікацію об’єктів, які використовують технології для взаємодії між собою та з навколишнім середовищем. Ця концепція дає змогу пристроям виконувати певні дії без втручання людини. Отже, усі пристрої в будинках, в автомобілях та інших системах інфраструктури повинні виконувати обробку інформації, її аналіз та здійснювати обмін між собою і залежно від результатів приймати рішення. </p> <p>Експерти стверджують, що Інтернет речей є однією з найперспективніших технологій остан- ніх років, що вже сьогодні фактично створює сотні нових продуктів і приводить до появи нових компаній на ринку, які диктують свої умови IT-гігантам. Споживач не зауважує, що він та його друзі чи колеги вже не перший рік кожного дня користуються такими пристроями. Більше того, у багатьох українських домівках вже встановлені системи “розумного будинку”, в які інтегровані десятки сенсорів.
                        </p>
                        <div class="image-left">
                            <img src="./content/article/it1.jpg" />
                            <p>
                                Термін “Інтернет речей” (англ. IoT) вперше був сформульований ще у 1999 році.
                            </p>
                        </div>
                        <p>
                            Сучасна сфера ІоТ – один із головних світових трендів. Навіть існуючі, старі функціонуючі пристрої можуть ставати частиною Інтернет-мережі і виконувати нові функції. Недарма цю галузь вважають рушієм 4-ї індустріальної революції, яка зараз триває у світі. Кількісний перехід від “Інтернету людей” до “Інтернету речей” відбувся у 2008–2009 рр. Саме у той період кількість пристроїв, підключених до Інтернету, перевищила кількість інтернет- користувачів, а тому світ поступово перейшов у нову фазу розвитку технологій – Інтернету речей. </p><p>За прогнозами аналітиків у найближчі роки очікується справжній бум Інтернету речей. Так, за прогнозами Gartner, до 2020 року кількість підключених до всесвітньої мережі пристроїв станови- тиме 26 мільярдів, а дохід від продажу устаткування, програмного забезпечення та послуг становитиме 1,9 трлн доларів. Найбільші світові IT-компанії, зокрема Intel, Google та ін., вже почали масштабну роботу на цьому ринку. Так, корпорація Intel у 2014 році створила власний підрозділ “Internet of Things Solutions Group” для розвитку цього напрямку. Компанія “Google” на початку 2014 року за 3,2 млрд доларів купила невелику фірму “Nest Labs”, яка займається випуском інтелектуальних термостатів. Спеціалісти компанії “Google” займаються широким впровадженням на американському ринку технологій IoT. Виробники побутової техніки також працюють у цьому напрямку.
                        </p>
                        <div class="image-right">
                            <img src="./content/article/it2.jpg" />
                            <p>
                                Прикладом впровадження Інтернету речей є система “розумний будинок”.
                            </p>
                        </div>
                        <p>
                            Однією із функцій “розумного будинку” є контроль параметрів навколишнього середовища, залежно від чого здійсню- ється регулювання температури в приміщеннях. У зимовий період нагріваючі прилади залежно від температури повітря ззовні, вітру, часу доби без втручання людини регулюють інтенсивність опалення, що дає змогу значно зменшити споживання енергоносіїв. Система “розумного будинку” сьогодні, мабуть, найбільше асоціюється з Інтернетом речей. Концепція передбачає використання звичних у побуті приладів, що вже порозумнішали: термостати, системи відеоспостереження, холодильники, телевізори тощо. Цей сегмент технологій ґрунтується на використанні ситуативних децентралізованих бездротових мереж. У будинках і офісах вже можна побачити безліч таких систем, з’являються нові й нові сервіси – віддалене спостереження через смартфон за власним помешканням або автоматичні клімат-системи будівель.
                        </p>
                    </div>
                </div>
                ',

                'text_en' => '
                <style>
            body {
                background: url("content/article/3.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }

               

                ul {
                  margin-top: 5%;
                }


                header {
                  width: 100%;
                  margin: 0 auto;
                  position: relative;
                justify-content: space-between;
                    align-items: center;
                   background-color: white;
                   opacity: 1;
                   height: 12vw;
                }

                .link {
                  display: inline-block;
                  float: right;
                }
                
              </style>
              <div class="act"></div>
              <h1>Internet of things</h1>
                    <div class="wrapper">
                        <div class="content-wrapper">
                            <span class="first-character">T</span>
                            <p>
                                he modern concept of Internet of things involves communicating objects that use technology to interact with each other and with the environment. This concept allows the device to perform certain actions without human intervention. Consequently, all devices in buildings, in cars and other infrastructure systems should process, analyze and interact with each other and, depending on the results, make decisions and perform certain actions. </ p> <p> Experts argue that Internet is one of the most promising technologies of recent years, which actually creates hundreds of new products and leads to the emergence of new companies in the market that dictate their conditions to IT giants. The consumer does not notice that he and his friends or colleagues are not the first year of every day using such devices. Moreover, many Ukrainian homes already have systems of "smart home", in which dozens of sensors are integrated.
                            </p>
                            <div class="image-left">
                                <img src="./content/article/it1.jpg" />
                                <p>
                                    The term "Internet of Things" (IoT) was first formulated in 1999. \
                                </p>
                            </div>
                            <p>
                                The modern sphere of IoT is one of the main world trends. Even existing, old functioning devices can become part of the Internet and perform new functions. No wonder this branch is considered the driving force of the 4th industrial revolution, which is now in the world. A quantitative transition from "Internet of people" to "Internet of Things" took place in 2008-2009. At that time, the number of devices connected to the Internet exceeded the number of Internet users, and therefore the world gradually became a new phase in the development of technologies - the Internet of Things. </ p> <p> According to analysts\' forecasts, the real boom of the Internet is expected in the coming years. So, according to Gartner, by 2020, the number of devices connected to the global network of devices will be 26 billion, and revenue from the sale of equipment, software and services will amount to 1.9 trillion dollars. The world\'s largest IT companies, including Intel, Google and others, have already begun large-scale operations on this market. So, in 2014, Intel created its own "Internet of Things Solutions Group" division to develop this direction. In early 2014, Google bought $ 3.2 billion for a small firm called Nest Labs, which is engaged in the production of intelligent thermostats. Experts from Google are engaged in a wide introduction to the American IoT technology market. Home appliances manufacturers are also working in this direction.
                            </p>
                            <div class="image-right">
                                <img src="./content/article/it2.jpg" />
                                <p>
                                    An example of the introduction of the Internet of things is the "smart home" system.
                                </p>
                            </div>
                            <p>
                                One of the functions of a "smart home" is the control of environmental parameters, depending on which the room temperature control is carried out. In the winter, heating devices regulate the intensity of heating, which can significantly reduce the energy consumption, depending on the temperature of the outside air, the wind, and the time of day without human intervention. The system of "smart home" today, perhaps, is most closely associated with the Internet of things. The concept implies the use of familiar devices in the home that have become more intelligent: thermostats, video surveillance systems, refrigerators, televisions, etc. This technology segment is based on the use of situational decentralized wireless networks. In homes and offices you can already see a lot of such systems, new and new services are available - remote monitoring via a smartphone for your own home or automatic climate building systems.
                            </p>
                        </div>
                    </div>
                 ',
            ],

            [
                'author_id' => $olgaId,
                'title_uk' => 'Штучний інтелект',
                'title_en' => 'Artificial intelligence',
                'image' => '4.jpg',
                'text_uk' => '
                <style>
            body {
                background: url("content/article/4.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }


                ul {
                  margin-top: 5%;
                }


                header {
                  width: 100%;
                  margin: 0 auto;
                  position: relative;
                justify-content: space-between;
                    align-items: center;
                   background-color: white;
                   opacity: 1;
                   height: 12vw;
                }

                .link {
                  display: inline-block;
                  float: right;
                }
                
              </style>
              <div class="act"></div>
              <h1>Штучний інтелект</h1>
                    <div class="wrapper">
                        <div class="content-wrapper">
                            <span class="first-character">Ш</span>
                            <p>
                                тучний інтелект (ШІ) – один із перспективних напрямів подальшого розвитку інформаційних систем та технологій. Для вирішення питань, пов’язаних із застосуванням систем штучного інтелекту, зосереджені великі зусилля фахівців у галузі кібернетики, лінгвістики, психології, філософії, математики та інженерів. Саме тут вирішується багатогранні питання, пов\'язані з шляхами розвитку наукової думки, з впливом досягнень в області обчислювальної техніки та робототехніки на життя майбутніх поколінь.
                            </p>
                            <div class="image-left">
                                <img src="./content/article/ai1.jpg"/>
                                <p>
                                    Незважаючи на вже тривалий розвиток систем ШІ, на даний момент немає навіть точного визначення штучного інтелекту.
                                </p>
                            </div>
                            <p>
                                Вчені не мають одностайної позиції у питанні визначення даного об’єкту досліджень: ведучи мову про штучний інтелект, його здебільшого тлумачать як формалізацію завдань і функцій, подібних до тих, які виконує людина.
                            </p>
                            <p>
                                Слід відзначити два підходи до штучного інтелекту, що склалися в сучасній філософії: сильна версія штучного інтелекту і слабка версія штучного інтелекту. Перша передбачає, що комп\'ютери можуть набути здатності до рефлексивної розумової діяльності й до усвідомлення себе, навіть якщо процес їх мислення буде відрізнятися від людського. Слабка версія штучного інтелекту відкидає будь-яку можливість мислення для комп\'ютерів.
                            </p>
                            <div class="image-right">
                                <img src="./content/article/ai2.jpg" />
                                <p>
                                    Ми уже стикаємось з слабкою формою штучного інтелекту щодня. Автомобілі/смартфони/комп\'ютери - він уже всюди.
                                </p>
                            </div>
                            <p>
                                Період 1960-70-х років позначився особливо інтенсивним обговоренням проблем, пов\'язаних зі створенням, функціонуванням і сутністю обчислювальних машин, що породило ряд метафор на кшталт: “електронний мозок”, “інтелектуальна машина”, “мислячий пристрій” тощо. Після того, як у Вашингтоні (1969) відбулась перша міжнародна конференція по штучному інтелекту, метафору «штучний інтелект» почали масово використовувати в науково-технічному середовищі.
                            </p>
                            <p>
                                Відносини між людиною і машиною в умовах розвитку систем штучного інтелекту і впровадження їх у людську повсякденність набувають дедалі більш складного і важко передбачуваного характеру. Використання штучного інтелекту має багато як позитивних так і негативних аспектів. Як влучно зазначає Б.Уітбі, що як і будь-яка інша технологія, штучний інтелект можна використовувати з позитивними соціальними наслідками, а можна і створити умови для соціальної катастрофи.
                            </p>
                        </div>
                    </div>
                    ',

                'text_en' => '
                <style>
            body {
                background: url("content/article/4.jpg") no-repeat;
                background-size: 100%;
                background-position: top center;
                margin: 0;
                padding: 0;
                background-attachment: fixed;
                color: #393941;
                font-family: Basier, Corbel, sans-serif;
              }
              .act {
                background-color: white;
            margin: 0 auto;
            padding: 0.1vw 0 0 0.1vw;
            }
            h1 {
                cursor: default;
                  font-size: 10vw;
                  line-height: 1;
                  text-align: center;
                  font-family: Basier, sans-serif;
                  text-transform: uppercase;
                  color: #fefefe;
                  margin: 12vw 1vw 10vw 1vw;
                font-weight: 600;
                text-shadow: 1vw 1vw 10vw rgba(99, 99, 99, 0.5)
                }
                img {
                  width: 100%;
                  vertical-align: middle;
                  border: 0;
                  margin: 0 0 10px 0;
                  height: auto;
                  position: unset;
                }

                .wrapper {
                    background: #fefefe;
                    width: 100%;
                    min-height: 100%;
                    margin: 0 0 0 0;
                    position: relative;
                  }
                  .content-wrapper {
                    padding: 5% 10%;
                    width: 100%;
                    margin: auto;
                    cursor: default;
                  font-size: 2.5vh;
                    line-height: 2;
                    }
                  .first-character {font-weight:400; float: left; font-size: 7vh; line-height: 2vh; padding-top: 4px; padding-right: 0.2vw; padding-left: 0px; }
                  .content-wrapper .image-left {
                    padding: 5% 5% 5% 0;
                    width: 50%;
                    float: left;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-left {
                      width: 100%;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-left img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-left:hover {
                    opacity: 1;
                  }
                  .content-wrapper .image-right {
                    padding: 5% 0 5% 5%;
                    width: 50%;
                    float: right;
                    opacity: 0.8;
                    -moz-transition-property: all;
                    -o-transition-property: all;
                    -webkit-transition-property: all;
                    transition-property: all;
                    -moz-transition-duration: 0.6s;
                    -o-transition-duration: 0.6s;
                    -webkit-transition-duration: 0.6s;
                    transition-duration: 0.6s;
                    -moz-transition-timing-function: ease-in;
                    -o-transition-timing-function: ease-in;
                    -webkit-transition-timing-function: ease-in;
                    transition-timing-function: ease-in;
                    font-size: 80%;
                    font-style: italic;
                    line-height: 20px;
                  }
                  @media (max-width: 900px) {
                    .content-wrapper .image-right {
                      width: 100%;
                      float: left;
                      padding: 0 0 5% 0;
                    }
                  }
                  .content-wrapper .image-right img {
                    margin: 0 0 10px 0;
                  }
                  .content-wrapper .image-right:hover {
                    opacity: 1;
                  }

                  p {
                    margin: 0 0 10px;  
                }


                ul {
                  margin-top: 5%;
                }


                header {
                  width: 100%;
                  margin: 0 auto;
                  position: relative;
                justify-content: space-between;
                    align-items: center;
                   background-color: white;
                   opacity: 1;
                   height: 12vw;
                }

                .link {
                  display: inline-block;
                  float: right;
                }
                
              </style>
              <div class="act"></div>
              <h1>Artificial Intelligence</h1>
                    <div class="wrapper">
                        <div class="content-wrapper">
                            <span class="first-character">A</span>
                            <p>
                                rtificial Intelligence (AI) is one of the promising directions for the further development of information systems and technologies. To solve issues related to the application of artificial intelligence, concentrated efforts of specialists in the field of cybernetics, linguistics, psychology, philosophy, mathematics and engineers. It is here that solves many-sided issues related to the ways of developing scientific thought, with the influence of advances in the field of computing and robotics on the lives of future generations.
                            </p>
                            <p>
                                Despite the prolonged development of AI systems, at this time there is no even precise definition of artificial intelligence. Scientists do not have a unanimous position regarding the definition of this object of research: while speaking about artificial intelligence, it is mostly interpreted as formalizing tasks and functions similar to those performed by a person.
                            </p>
                            <div class="image-left">
                                <img src="./content/article/ai1.jpg" />
                                <p>
                                    It should be noted two approaches to artificial intelligence in the modern philosophy: a strong version of artificial intelligence and a weak version of artificial intelligence.
                                </p>
                            </div>
                            <p>
                                The first suggests that computers can acquire the ability to reflexive mental activity and awareness of themselves, even if the process of their thinking will be different from human. A weak version of artificial intelligence discourages any thinking ability for computers.
                            </p>
                            <p>
                                The period from the 1960s and 1970s was marked by a particularly intense discussion of problems associated with the creation, operation and essence of computers, which gave rise to a number of metaphors such as: "electronic brain", "intellectual machine", "thinking device," etc. . After the first international conference on artificial intelligence in Washington (1969), the "artificial intelligence" metaphor began to be used massively in the scientific and technical environment.
                            </p>
                            <p>
                                The relationship between man and machine in the development of systems of artificial intelligence and their introduction into human everyday life becomes increasingly complex and difficult to predict.
                            </p>
                            <p>
                                The use of artificial intelligence has many positive and negative aspects. As B. Uitbe accurately points out, that, like any other technology, artificial intelligence can be used with positive social consequences, and you can also create conditions for a social catastrophe.
                            </p>
                        </div>
                    </div>
              ',
            ],
        ]);

        $articles->create();
    }
}
