-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 01 2015 г., 23:09
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `red_btr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `date`, `parent_id`, `name`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
(1, '2015-02-13', 7, 'Новости', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', '', '', '', 'novosti'),
(3, '2015-02-14', 1, 'Внедорожные мероприятия', 0, '', '', '', '', 'vnedorozhnye-meropriyatiya'),
(5, '2015-02-20', 3, 'Lorem ipsum dolor sit amet, consectetur...', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', '', '', '', 'lorem-ipsum-dolor-sit-amet-consectetur'),
(6, '2015-02-03', 1, 'Июнь', 0, '<p>Команда redBTR Sport участвует&nbsp;в Трофи-рейде &quot;Ладога&quot;&nbsp; в&nbsp;категории Adventure.</p>\r\n', '', '', '', 'lorem-ipsum-dolor-sit-amet-consectetu'),
(7, '2015-02-14', 0, 'О нас', 0, '', '', '', '', 'o-nas'),
(8, '2015-02-17', 1, 'Статьи', 0, '', '', '', '', 'stati'),
(9, '2015-02-16', 8, 'Статья о внедорожниках', 0, '<p>Внедорожник&nbsp;(от английского off-road vehicle) &mdash; это полноприводный автомобиль повышенной<br />\r\nпроходимости, где все 4 колеса являются ведущими, с колесной формулой 4х4. Внедорожники<br />\r\nпредназначены для эксплуатации на всех типах дорог и на пересеченной местности. Уже много<br />\r\nлет, а точнее с конца 40-х годов прошлого века, с легкой руки американской<br />\r\nжурналистки Катарины Хилльер к классическим автомобилям повышенной проходимости<br />\r\n(внедорожникам) &laquo;прилипло&raquo; название&nbsp;&laquo;Jeep&raquo; (Джип).<br />\r\nОпределения. История внедорожника<br />\r\nПрежде чем перейти к истории возникновения такого явления как&nbsp;Офф-роуд (off-road), считаем<br />\r\nнеобходимым дать точную дефиницию самого термина &ndash; классический переводчик (dictionarist.com) дает следующий перевод или определение: прил.&nbsp;вездеходный, бездорожный, находящийся вдали от дорог. Считаем наиболее корректным переводом этого англоязычного термина &laquo;внедорожный&raquo;, тем более, в русском языке это слово давно прижилось и даже стало употребляться в сочетании со многими иными словами и терминами, приведем лишь некоторые: внедорожный просвет, внедорожный размер, внедорожная шина и тому подобное. При этом самое популярное и наиболее часто встречающееся слово, связанное с понятием &laquo;Офф-роуд&raquo; &mdash; слово &laquo;Внедорожник&raquo;.<br />\r\nПоследнее является прямым производным от русскоязычного значения термина &laquo;Off-road&raquo;, от слов &laquo;вездеходный&raquo;, &laquo;внедорожный&raquo;. Что же, в свою очередь, означает русскоязычное слово<br />\r\n&laquo;внедорожник&raquo;? В отношении происхождения слова &laquo;Jeep&raquo; существуют разные версии, однако наиболее распространенной является следующая: армия США накануне Второй Мировой Войны объявила конкурс на разработку, производство и поставку для военных нужд многоцелевого легкового автомобиля, и в 1940 году американский&nbsp;инженер Карл Пробст&nbsp;сконструировал для фирмы BantamBRC&nbsp;полноприводный автомобиль, ставший прототипом знаменитого&nbsp;Виллиса. Позже крупная компания &laquo;Willys - Overland&raquo; в сотрудничестве с компанией-гигантом &laquo;Ford Motor Co.&raquo; доработала модель компании-разработчика и стала производить и поставлять для армии США и ее союзников автомобили&nbsp;Ford GPW, аббревиатура GPW означала: G &mdash; государственный заказ; Р &mdash; автомобиль с колёсной базой до 80 дюймов; W &mdash; тип Willys, поскольку автомобиль выпускался компанией Ford Motor Co. по технической документации компании Willys. Американские солдаты и офицеры, ценя и любя этот автомобиль, спасший тысячи жизней в той страшной войне, называли его по первым двум буквам той самой аббревиатуры &ndash; GP, что звучало как &laquo;ДжиПи&raquo;, это сокращенное название прижилось благодаря краткости и исключительной популярности этого автомобиля, а позже трансформировалось в известное по всему миру &laquo;Jeep&raquo;. Спустя годы с маркой &laquo;Jeep&raquo; (Джип) произошло то же, что и с не менее знаменитым &laquo;Xerox&raquo;, когда любая копировальная машина стала массово называться Ксероксом. Более того, слово &laquo;Джип&raquo; стало обозначением &laquo;правильного&raquo; классического внедорожника &ndash; рамного, полноприводного, укомплектованного РК (раздаточной<br />\r\nкоробкой).</p>\r\n\r\n<p>Полноприводные автомобили, теперь уже Джипы, оказались полезными не только в военном<br />\r\nприменении. Как это часто бывает, армейские разработки и технологии становятся со временем<br />\r\nдоступны и гражданской промышленности, так произошло и с Джипом: полноприводные автомобили помогли людям всего мира стать более свободными, освоить уголки планеты, остававшиеся нетронутыми с самого сотворения мира!</p>\r\n\r\n<p>История создания Советского внедорожника, в свою очередь, неразрывно связана с городом<br />\r\nУльяновск и с заводом, который начинает строиться в первый военный год, в грозный 1941. В июле 1941 года Государственный Комитет Обороны СССР принимает решение об эвакуации из Москвы ряда крупнейших предприятий. Среди прочих, решением Правительства СССР в город Ульяновск эвакуируется часть Московского автомобильного завода вместе с оборудованием.<br />\r\nК маю 1942 года на Ульяновском автомобильном заводе было собрано пять первых автомобилей<br />\r\nЗИС-5. К июлю того же года темпы сборки возросли до 30 машин в сутки. Заводом для нужд<br />\r\nвоюющей страны собираются и отправляются на фронт сотни грузовых автомобилей.<br />\r\n13 марта 1949 года с конвейера Ульяновского завода сходит 10-тысячный грузовик, а в 1954 году<br />\r\nсоздается отдел главного конструктора (ОГК) и начинается разработка новых автомобилей семейства УАЗ &ndash; тех самых, которые знают и любят несколько поколений советских и российских людей. Уже в 1959 году автомобили Ульяновского завода, благодаря своей высокой репутации, благодаря надежности и неприхотливости в эксплуатации, экспортируются в 22 страны мира!<br />\r\nВ декабре 1972 года с конвейера Ульяновского автозавода сходит первая партия знаменитого<br />\r\nУАЗ-469, а уже в феврале 1974 завод выпускает свой миллионный автомобиль марки УАЗ.<br />\r\nВ 1997 году Ульяновский автозавод производит первую партию автомобилей УАЗ-3160, являющихся прообразом будущего популярного и современного УАЗа PATRIOT, который в народе обретет шутливое и дружеское прозвище &laquo;Патрик&raquo;. И, наконец, 17 августа 2005 года начинается серийное производство самой современной модели Ульяновского автозавода &ndash; УАЗ-3163 Патриот. ОАО &laquo;УАЗ&raquo; много лет идет к этой модели, первые разработки ведутся еще с 80-х годов двадцатого века! Уже в 2005 году для сборки этого автомобиля применяется порядка 20% импортных комплектующих, а для качественной сборки производится масштабная модернизация сборочного конвейера: запускается новая сварочная линия, строится новый окрасочный комплекс &laquo;Eisenmann&raquo;.<br />\r\nВ 2011 году Ульяновскому автозаводу исполняется 70 лет, и к тому времени УАЗ Patriot завоевывает несколько престижных премий, в том числе и международных. В марте того же года (2011) внедорожник UAZ Patriot занимает первое место в номинации &laquo;Отечественный автомобиль&raquo; в национальной автомобильной Премии &laquo;Лучшее авто по версии Рунета&raquo;, учредителем которой является Авто@Mail.Ru. И, несмотря на то, что в 2014 году ОАО &laquo;УАЗ&raquo; анонсирует спуск с конвейера последнего автомобиля-потомка легендарного УАЗ-469, сворачивая производство УАЗ Hunter, эта утрата все же компенсируется тем, что в России остается и модернизируется производство настоящего Отечественного Автомобиля, разработанного российскими конструкторами, Автомобиля, который покоряет бездорожье не только в России, но и в десятках стран мира, куда экспортируется наш российский Джип - УАЗ Патриот!<br />\r\nБезусловно, УАЗ не является единственным российским внедорожником. Не стоит забывать и о<br />\r\nполноприводном автомобиле концерна ВАЗ, не менее знаменитая &laquo;Нива&raquo; пользуется большой<br />\r\nпопулярностью у российского народа!<br />\r\nКак мы с Вами смогли убедиться, история Советского и Северо-Американского джипов насчитывает приблизительно одно и то же время и даже причины разработки этих полноприводных автомобилей одинаковы, Джипы успели повоевать, прежде чем прочно укоренились в гражданской жизни.<br />\r\nСовременное Офф-роудное Движение<br />\r\nЧто же касается Офф-роудного движения в России, то это явление достаточно &laquo;молодое&raquo;, принято<br />\r\nсчитать, что у истоков его стоят две довольно известные фигуры &ndash; директор российского холдинга<br />\r\n&laquo;Бастион&raquo;&nbsp;Александр Зайцев, который в конце 90-х годов прошлого века побывал на схожих<br />\r\nсоревнованиях в Бангкоке и &laquo;заболел&raquo; идеей организации подобных массовых мероприятий в<br />\r\nРоссии, а также&nbsp;Виктор Дьячков, чемпион России по спортивному ориентированию. Первая же<br />\r\nорганизованная ими гонка под названием &laquo;Rally-Family&raquo; имела грандиозный успех, она состоялась в 2000 году и явилась своеобразной площадкой для создания клуба &laquo;4х5 Чернозём&raquo;.<br />\r\nТакже, одним из наиболее старейших и наиболее авторитетных клубов России является офф-роуд клуб &laquo;&nbsp;Ладога&raquo;. Этот Санкт-Петербургский клуб, помимо большого количества серьезных и<br />\r\nавторитетных участников, известен еще и тем, что именно он является автором знаменитого трофи-рейда &laquo;Ладога&raquo;. Как заявляют сами организаторы трофи-рейда: &laquo;Ладога&raquo; - это крупнейшее в мире приключение 4х4!&raquo; Организаторы, несмотря на помпезность и безапелляционность такого заявления, все же не голословны &ndash; о статусности и масштабе мероприятия говорит уже тот факт, что ежегодное открытие-презентация проводится в историческом центре Санкт-Петербурга, на Исаакиевской площади, где собираются сотни отлично подготовленных к любым испытаниям машин, это и шоу и своеобразная &laquo;демонстрация сил и амбиций&raquo;, как перед титульным боем!<br />\r\nПеред этим шоу-стартом, за два дня до начала гонок, начинается регистрация, автомобили и<br />\r\nквадроциклы проверяются на техническое соответствие и безопасность. На все автомобили и<br />\r\nквадроциклы устанавливаются системы электронного хронометража и GPS слежения. Всему этому, в свою очередь, предшествует гигантская работа, проводимая организаторами задолго до старта &ndash; разведываются новые трассы, корректируются старые, для каждой команды-участницы составляются спортивные легенды на каждый день соревнований. Расписываются старты и финиши, маршруты и протяженность трасс, а также время их прохождения.<br />\r\nЭти суровые соревнования для настоящих Мужиков проходят по всему побережью Ладожского озера, организаторы намеренно выстраивают маршруты по пересеченной местности, изобилующей топями, оврагами, болотами и иными естественными преградами &ndash; сопками, ущельями, ручьями и реками.<br />\r\nВсех участников &laquo;Ладоги&raquo; объединяет любовь к приключениям, желание хлебнуть &laquo;экстрима&raquo; и<br />\r\nоторваться напрочь от обычной городской и деловой суеты. Экипажи &laquo;Ладоги&raquo; соревнуются в 3<br />\r\nкатегориях &ndash; Категория &laquo;SPORT&raquo;, Категория &laquo;ADVENTURE&raquo; и Категория &laquo;TOURISM&raquo;, кроме того в этих категориях существуют группы или классы, и присутствие автомобиля в том или ином классе зависит от уровня подготовки конкретного автомобиля, а также от уровня амбиций экипажа.<br />\r\nВообще, само явление &laquo;Клубного Офф-роуда&raquo; заслуживает отдельной статьи, мы постараемся лишь в общих чертах остановиться на социально-экономических причинах возникновения и динамики этой активности. Для начала несколько цифр, полученных нашей компанией в результате проведенных исследований:<br />\r\nПо количеству off-road мероприятий всех типов (спортивных, командных, туристических, клубных) в период с 1998 по 2003 год в России наблюдался активный рост, в период с 2004 по 2008 год &ndash; стабильный рост, а в период кризиса 2009 &ndash; 2010 года наблюдалось постепенное снижение, которое в 2010 году достигло -25% по количеству мероприятий, и снижение до -30% по количеству участников. По нашим оценкам, общее снижение активности в off-road сегменте составило в 2010 году до -28%&hellip;-30%. С 2011 года наблюдается постепенное оживление сегмента, а 2013 год явился наиболее активным из всей истории движения off-road. На конец марта 2013 года в календарях мероприятий различных российских off-road клубов было заявлено более 130 мероприятий, не считая клубных, что превышает показатель 2012 года на 17%. Что же касается клубных мероприятий, то только по основным клубам количество клубных мероприятий и количество участников превышает показатели 2012 года не менее чем на 15%.<br />\r\nСогласно исследований, проведенных компанией&nbsp;redBTR, в России на сегодняшний день<br />\r\nсуществует свыше 100 клубов с различным количеством участников и различной направленности.<br />\r\nОбщая численность автомобилей, активно участвующих в различных спортивных, туристических и клубных мероприятиях, по нашим оценкам, составляет не менее 15.000 автомобилей разного уровня подготовки, при этом&nbsp;общее количество участников российских off-road клубов составляет не менее 130.000 человек. Есть несколько всероссийских клубов с максимальным количеством<br />\r\nучастников, к таковым относится, например клуб&nbsp;УАЗ Патриот&nbsp;www.uazpatriot.ru, а также клуб&nbsp;Джип 4х4&nbsp;- www.jeep4x4club.ru, в которых состоят 21284 и 25456 участников соответственно (по состоянию на 2014 год). Наибольшее количество территориальных клубов находится, что вполне естественно, в городах: Москва (9 клубов - 11.000 участников), Санкт-Петербург (7 клубов - 9.000 участников) и в Московской области (4 клуба - 6.600 участников). Также к крупнейшим региональным клубам относятся такие клубы как Краснодарский &laquo;Скиф 4х4&raquo; -&nbsp;www.skif4x4.ru&nbsp;(5.000 участников) и Саратовский клуб &laquo;СКВ&raquo; -&nbsp;www.saratoff-road.com&nbsp;(свыше 9.000 участников), данные цифры также приведены по состоянию на 2014 год. По составу автомобильных марок большинство внедорожных клубов являются &laquo;разношерстными&raquo;, встречаются &laquo;представители&raquo; чуть ли не всего мирового автопрома, однако, большинство автомобилей-участников все же являются отечественными автомобилями, преимущественно марки УАЗ. Наиболее выдающимся в этом смысле клубом является один из самых старых и самых авторитетных российских клубов &ndash; Тверской офф-роуд клуб &laquo;Лебедушка&raquo;, где численность УАЗов по признанию руководителей клуба достигает 80% от общего числа участников!<br />\r\nОсновное количество активных участников Офф-роудного движения приходится на Центральный<br />\r\nФедеральный Округ, около 35% от общего числа, на Северо-Западный Федеральный Округ &ndash; около 11%. На Приволжский Федеральный Округ приходится около 17%, на Сибирский -12%, остальные Федеральные Округа не превышают 10% от общего числа участников. Данные цифры, безусловно, являются приблизительными, но и они достаточно ярко демонстрируют масштаб этого поистине &laquo;Всероссийского Движения&raquo;! Однако масштабным это Движение является не только в РФ, традиционно все тренды и новые течения приходят к нам из США и Австралии. Австралия &ndash; гигантский континент, где жизнь немыслима без полноприводного автомобиля &ndash; засушливые пустыни, горы, предгорья &ndash; все это делает Австралию центром Офф-Роудной Индустрии всего мира, многие знаменитые Офф-Роудные бренды - &laquo;Tough Dog&raquo;, &laquo;Iron Man&raquo; и другие - создавались именно в этой стране и лишь спустя годы стали создавать представительства и филиалы на других континентах.</p>\r\n\r\n<p>Интерес российских людей к этому движению нескольким различными факторами, основным из<br />\r\nкоторых, на наш взгляд является идея свободы, приключений и испытаний, которые в большом<br />\r\nассортименте предоставляет Офф-роуд или Внедорожное Движение! Офф-роуд объединяет<br />\r\nсовершенно разных людей различных профессий: слесарей, пенсионеров, военных, клерков,<br />\r\nстудентов и владельцев крупных бизнесов! Некоторые клубы создаются под мероприятия<br />\r\n&laquo;лайтового&raquo; типа, участники выезжают на лесное ориентирование, отмечают на природе День<br />\r\nРождения своего Клуба и многие иные светские и религиозные праздники. Кроме того, большинство российских офф-роуд клубов берут на себя некоторые<br />\r\nблаготворительные миссии, как например, помощь детским домам или проведение акций по<br />\r\nсбору средств для помощи тем, кто оказывается в тяжелой жизненной ситуации. Подавляющее<br />\r\nбольшинство участников внедорожных клубов &ndash; это люди с активной жизненной позицией, люди,<br />\r\nлюбящие и знающие свою страну, и именно поэтому значительная часть выездных мероприятий связана с долгими и увлекательными путешествиями по России. Безусловно, далеко не все участники этих клубов могут позволить себе подготовку автомобиля к длительным и непростым путешествиям, однако, наиболее активные члены клубов, как правило, и являются тем самым &laquo;костяком&raquo;, который участвует в длительных и суровых испытаниях-автопробегах!<br />\r\nВнедорожный сегмент рынка автокомпонентов<br />\r\nС учетом той статистики, которую авторы статьи привели выше, становится понятной причина, по<br />\r\nкоторой в РФ, как, впрочем, и во всем мире с каждым годом создаются все новые компании,<br />\r\nпредлагающие энтузиастам внедорожного движения различные аксессуары для тюнинга серийных<br />\r\nавтомобилей. Растет и количество брендов, позиционирующих себя как производителей товаров для офф-роуда и для активной жизни. Несмотря на то, что этот сегмент рынка является довольно-таки узким, &laquo;нишевым&raquo;, многие российские и зарубежные компании обращают внимание на этот рынок, как минимум, по причине его стремительного роста! Очевидно, что данный сегмент прирастает не только за счет спортсменов или профессионалов движения, но, в первую очередь, за счет новичков или так называемых &laquo;покатушечников&raquo;. Это &ndash; как раз та значительная часть внедорожного движения, которая формирует массовый спрос на офф-роудные аксессуары, те самые начинающие &laquo;джиперы&raquo;, что уже вкусили внедорожного &laquo;драйва&raquo; и стали посещать различные клубные мероприятия, пусть даже и не являясь пока членами какого-либо внедорожного клуба. Спрос, как известно, рождает предложение, и бизнес стремительно реагирует на этот спрос, в крупных областных центрах уже, как правило, существует один, а иногда и несколько магазинов, которые являются представителями целого ряда известных внедорожных брендов и предлагают различные товары для офф-роуда. Вместе с тем, основной объем продаж внедорожных аксессуаров приходится на интернет-магазины.</p>\r\n', '', '', '', 'klevaya-statya');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(1, 1, 0, 'Обвес', '', '', '', 'obves', 0, ''),
(2, 1, 2, 'Комплекты патрубков', '', '', '', 'komplekty-patrubkov', 0, ''),
(3, 1, 3, 'Электроника', '', '', '', 'elektronika', 0, ''),
(4, 1, 1, 'Домкраты', '', '', '', 'domkraty', 0, ''),
(5, 1, 0, 'Инверторы', '', '', '', 'invertory', 3, ''),
(6, 1, 0, 'Пусковые аккумуляторы', '', '', '', 'puskovye-akkumulyatory', 3, ''),
(7, 1, 0, 'Аксессуары', '', '', '', 'aksessuary', 3, ''),
(8, 1, 1, 'Домкраты гидравлические', '', '', '', 'domkraty-gidravlicheskie', 4, ''),
(9, 1, 2, 'Домкраты винтовые', '', '', '', 'domkraty-vintovye', 4, ''),
(10, 1, 0, 'Аксессуары', '', '', '', 'aksessuary', 4, '');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE IF NOT EXISTS `characteristics` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `object_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `type`, `value`, `object_type`, `object_id`) VALUES
(1, 'po-primenyaemosti', 'AVT (Quatro Crazy)', 'products', 5),
(2, 'po-primenyaemosti', 'Водный транспорт (Mission Naval)', 'products', 4),
(3, 'po-primenyaemosti', 'Туризм (Country side)', 'products', 6),
(4, 'po-primenyaemosti', 'Промышленность (Mission SOS)', 'products', 1),
(5, 'po-primenyaemosti', 'Тяжелое бездорожье и внедорожный спорт (Mission Impossible)', 'products', 2),
(6, 'po-primenyaemosti', 'Тяжелое бездорожье и внедорожный спорт (Mission Impossible)', 'products', 3),
(7, 'po-primenyaemosti', 'Водный транспорт (Mission Naval)', 'products', 1),
(8, 'po-tipu', '1-ый тип', 'products', 1),
(9, 'po-tipu', '2-ой тип', 'products', 1),
(10, 'po-tipu', '4-ий тип', 'products', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics_type`
--

CREATE TABLE IF NOT EXISTS `characteristics_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `characteristics_type`
--

INSERT INTO `characteristics_type` (`id`, `name`, `url`) VALUES
(1, 'По применяемости', 'po-primenyaemosti'),
(2, 'По типу', 'po-tipu');

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('afa5a1ada05183c42da1cea338482497', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1425236889, 'a:3:{s:4:"user";O:8:"stdClass":17:{s:2:"id";s:2:"50";s:9:"last_name";s:18:"Лукинский";s:4:"name";s:8:"Паша";s:10:"patronymic";s:0:"";s:8:"password";s:0:"";s:5:"email";s:0:"";s:5:"phone";s:0:"";s:4:"city";s:0:"";s:6:"street";s:0:"";s:5:"house";s:0:"";s:8:"building";s:0:"";s:9:"apartment";s:0:"";s:8:"zip_code";s:0:"";s:11:"valid_email";s:1:"0";s:6:"vk_uid";s:9:"vk-439844";s:9:"vk_avatar";s:54:"http://cs617419.vk.me/v617419844/1427e/ZRxl2-Ez8sI.jpg";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:13:"cart_contents";a:3:{s:5:"items";a:0:{}s:10:"cart_total";s:0:"";s:9:"total_qty";s:0:"";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `dealers`
--

CREATE TABLE IF NOT EXISTS `dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `description`, `region`) VALUES
(1, '1-ый диллер', '', 'al'),
(2, '2-ой диллер', '', 'kn'),
(3, '3-ий диллер', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', 'ps'),
(4, '4-ый дилер', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', 'ps');

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `dynamic_menus`
--

INSERT INTO `dynamic_menus` (`id`, `name`, `description`) VALUES
(1, 'top_menu', ''),
(2, 'Меню панели администратора', '');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `name`, `type`, `subject`, `description`, `is_delete`) VALUES
(1, 'Администратору при заказе', 1, 'Новый заказ', '<p>Кллиент %user_name% оформил заказ № %order_id%.</p>\r\n', 0),
(2, 'Клиенту при заказе', 1, 'Заказ %order_id% в интернет магазине', '<p>Менеджер свяжется с Вами %user_name%.</p>\r\n', 0),
(3, 'Клиенту при изменении статуса заказа', 1, 'Статус Вашего заказа изменен', '<p>Уважаемый %user_name%. Статус Вашего заказа %order_id% изменен на %order_status%</p>\r\n', 0),
(4, 'При регистрации', 1, 'Подтверждение email', '<p>%user_name%, спасибо за регистрацию в нашем магазине.</p>\r\n\r\n<p>Для подтверждения email перейдите по <a href="%site_url%account/set_valid?email=%login%" target="_blank">ссылке</a></p>\r\n', 0),
(5, 'При изменении пароля', 1, 'Ваш пароль изменен', '<p>%user_name%, Ваш пароль в интернет магазине изменен. Новые данный доступа Ваш логин %login% Ваш пароль %password%</p>\r\n', 0),
(6, 'Обратный звонок', 1, 'Заказан обратный звонок', '', 0),
(7, 'Пробный шаблон рассылки', 2, 'Пробное письмо', '<table border="1" cellpadding="1" cellspacing="1" style="width:500px">\r\n	<tbody>\r\n		<tr>\r\n			<td>ываываыу</td>\r\n			<td>ывыупыупы</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ыпыупыуп</td>\r\n			<td>ыупыупы</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ыпыупыупыуы</td>\r\n			<td>ыупыупыуп</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `filials`
--

CREATE TABLE IF NOT EXISTS `filials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `filials`
--

INSERT INTO `filials` (`id`, `name`, `phone`, `caption`) VALUES
(1, 'Санкт-Петербург', '8 (800) 770 04 07', 'Санкт-Петербург');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `is_cover` int(1) NOT NULL DEFAULT '0',
  `object_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(2) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `url`) VALUES
(1, 1, 'products', 1, '/8/4/84d981fb350911e4943200259019918b-371dd85da55a11e491b3005056991d0b.jpg'),
(2, 0, 'products', 1, '/8/4/84d981fb350911e4943200259019918b-371dd85ea55a11e491b3005056991d0b.jpg'),
(3, 0, 'products', 1, '/8/4/84d981fb350911e4943200259019918b-371dd85fa55a11e491b3005056991d0b.jpg'),
(4, 1, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d40a55911e491b3005056991d0b.jpg'),
(5, 0, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d41a55911e491b3005056991d0b.jpg'),
(6, 0, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d42a55911e491b3005056991d0b.jpg'),
(7, 0, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d43a55911e491b3005056991d0b.jpg'),
(8, 1, 'products', 3, '/e/f/ef61b710350711e4943200259019918b-2fa10d42a55911e491b3005056991d0b[1].jpg'),
(9, 0, 'products', 3, '/4/d/4dceb184350811e4943200259019918b-2fa10d47a55911e491b3005056991d0b.jpg'),
(10, 0, 'products', 3, '/4/d/4dceb184350811e4943200259019918b-2fa10d48a55911e491b3005056991d0b.jpg'),
(11, 0, 'products', 3, '/4/d/4dceb184350811e4943200259019918b-2fa10d4aa55911e491b3005056991d0b.jpg'),
(12, 1, 'products', 4, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f75a54f11e491b3005056991d0b.jpg'),
(13, 0, 'products', 4, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f73a54f11e491b3005056991d0b.jpg'),
(14, 0, 'products', 4, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f74a54f11e491b3005056991d0b.jpg'),
(15, 1, 'products', 5, '/1/2/1261098ee40a11e3956f00155d0a2e33-7e520f78a54f11e491b3005056991d0b.jpg'),
(16, 0, 'products', 5, '/1/2/1261098ee40a11e3956f00155d0a2e33-7e520f76a54f11e491b3005056991d0b.jpg'),
(17, 0, 'products', 5, '/1/2/1261098ee40a11e3956f00155d0a2e33-7e520f77a54f11e491b3005056991d0b.jpg'),
(18, 1, 'products', 6, '/4/e/4ef7e4cf89af11e4943200259019918b-4ef7e4d089af11e4943200259019918b.jpg'),
(19, 0, 'products', 5, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f73a54f11e491b3005056991d0b[1].jpg'),
(20, 0, 'products', 5, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f74a54f11e491b3005056991d0b[1].jpg'),
(35, 1, 'products', 9, '/1/0/10422122-714908408624038-6412271962746173059-n.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `mailouts`
--

CREATE TABLE IF NOT EXISTS `mailouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `users_ids` varchar(300) DEFAULT NULL,
  `mailouts_date` date DEFAULT NULL,
  `success` int(11) NOT NULL,
  `no_success` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `mailouts`
--

INSERT INTO `mailouts` (`id`, `template_id`, `users_ids`, `mailouts_date`, `success`, `no_success`) VALUES
(1, 7, '1/2', '2015-02-19', 0, 0),
(2, 7, '1/2', '2015-02-19', 0, 0),
(3, 7, '1/2', '2015-02-19', 0, 0),
(4, 7, '1/2', '2015-02-19', 0, 0),
(5, 7, '1/2', '2015-02-19', 0, 0),
(6, 7, '1/2', '2015-02-19', 0, 0),
(7, 7, '1/2', '2015-02-19', 0, 0),
(8, 7, '1/2', '2015-02-19', 0, 0),
(9, 7, '1/2', '2015-02-19', 0, 0),
(10, 7, '1/2', '2015-02-19', 0, 0),
(11, 7, '1/2', '2015-02-19', 0, 0),
(12, 7, '1/2', '2015-02-19', 0, 0),
(13, 7, '1/2', '2015-02-19', 0, 0),
(14, 7, '1/2', '2015-02-19', 0, 0),
(15, 7, '1/2', '2015-02-19', 0, 0),
(16, 7, '1/2', '2015-02-19', 0, 0),
(17, 7, '1/2', '2015-02-19', 5, 0),
(18, 7, '1/2', '2015-02-19', 0, 0),
(19, 7, '1/2', '2015-02-19', 0, 0),
(20, 7, '1/2', '2015-02-19', 0, 0),
(21, 7, '1/2', '2015-02-19', 0, 0),
(22, 7, '1/2', '2015-02-19', 0, 0),
(23, 7, '1/2', '2015-02-19', 2, 2),
(24, 7, '1/2', '2015-02-19', 2, 0),
(25, 7, '1/2/3', '2015-03-01', 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `menus_items`
--

CREATE TABLE IF NOT EXISTS `menus_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort` int(3) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `item_type` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=73 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(2, 1, 'Где купить', 0, 1, '', 'articles', 'gde-kupit'),
(3, 1, 'О нас', 0, 2, '', 'articles', 'o-nas'),
(4, 1, 'Контакты', 0, 3, '', 'link', 'kontakty'),
(5, 1, 'Авторезированные сервис центры', 1, 1, '', 'articles', 'avtorezirovannye-servis-centry'),
(6, 1, 'Регистрация и вход', 1, 2, '', 'link', 'йцукен'),
(7, 1, 'Поддержка клиентов', 0, 0, '', 'articles', 'podderzhka-klientov'),
(19, 1, 'Как стать дилером', 2, 1, '', 'link', 'dealers'),
(28, 1, 'Авторизованные сервис центры', 27, 1, '', 'articles', 'avtorizovannye-servis-centry'),
(30, 2, '<i class=icon-home></i>', 0, 0, '', 'link', '/admin'),
(31, 2, 'Статьи', 0, 0, '', 'link', '#'),
(32, 2, 'Все статьи', 31, 0, '', 'link', '/admin/content/items/articles'),
(33, 2, 'Новости', 31, 0, '', 'link', '/admin/content/items/articles/1'),
(34, 2, 'Каталог', 0, 0, '', 'link', '#'),
(35, 2, 'Категории', 34, 0, '', 'link', '/admin/content/items/categories'),
(36, 2, 'Создать категорию', 34, 0, '', 'link', '/admin/content/item/edit/categories'),
(37, 2, 'Товары', 34, 0, '', 'link', '/admin/content/items/products'),
(38, 2, 'Создать товар', 34, 0, '', 'link', '/admin/content/item/edit/products'),
(39, 2, 'Дополнения', 0, 0, '', 'link', '#'),
(40, 2, 'Слайдер', 39, 0, '', 'link', '/admin/content/items/slider'),
(41, 2, 'Видео', 39, 0, '', 'link', '/admin/content/items/video'),
(42, 2, 'Филиалы', 39, 0, '', 'link', '/admin/content/items/filials'),
(43, 2, 'Дилеры', 39, 0, '', 'link', '/admin/content/items/dealers'),
(44, 2, 'Заказы', 0, 0, '', 'link', '/admin/admin_orders'),
(45, 2, 'Настройки', 0, 0, '', 'link', '/admin/content/item/edit/settings/1'),
(46, 2, 'Меню', 0, 0, '', 'link', '/admin/menu_module/menus'),
(47, 2, 'Рассылки', 0, 0, '', 'link', '#'),
(48, 2, 'Шаблоны', 47, 0, '', 'link', '/admin/content/items/emails/2'),
(49, 2, 'Рассылки', 47, 0, '', 'link', '/admin/mailouts_module/'),
(50, 2, 'Системные письма', 47, 0, '', 'link', '/admin/content/items/emails/1'),
(51, 2, 'Пользователи', 0, 0, '', 'link', '#'),
(52, 2, 'Пользователи', 51, 0, '', 'link', '/admin/users_module/'),
(53, 2, 'Группы пользователей', 51, 0, '', 'link', '/admin/content/items/users_groups/'),
(55, 1, 'Новости', 3, 1, '', 'articles', 'novosti'),
(57, 1, 'Внедорожные мероприятия', 55, 1, '', 'articles', 'vnedorozhnye-meropriyatiya'),
(58, 1, 'Новости', 55, 0, '', 'articles', 'novosti'),
(59, 2, 'Продажи и сервис', 39, 1, '', 'link', '/admin/content/items/sells_services'),
(60, 1, 'Продажи и сервис', 2, 2, '', 'link', 'sells_services'),
(62, 1, 'Статьи', 55, 2, '', 'articles', 'stati'),
(70, 1, 'Geyrn', 58, 1, '', 'articles', ''),
(72, 2, 'Характеристики', 34, 1, '', 'link', '/admin/content/items/characteristics_type');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` text COLLATE utf8_unicode_ci NOT NULL,
  `user_address` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(10) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `message`, `city_id`, `total`, `delivery_id`, `payment_id`, `date`, `status_id`) VALUES
(1, '27', 'admin', 'admin@admin.ru', '88585858585', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 304505500, 0, 0, '2015-02-17 00:00:00', 1),
(2, '27', 'admin', 'admin@admin.ru', 'q34234234', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 93694000, 0, 0, '2015-02-18 00:00:00', 1),
(3, '50', 'Паша', '', '85558', '  ', '', NULL, 939, 0, 0, '2015-03-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `product_price` text COLLATE utf8_unicode_ci NOT NULL,
  `order_qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_qty`) VALUES
(1, '1', 9, 'шакл &quot;адмирал&quot;', '23423500', 13),
(2, '2', 9, 'шакл "адмирал"', '23423500', 4),
(3, '3', 1, 'Преобразователь напряжения с 24/12V (автомобильный) 10A **', '939', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `is_good_buy` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `warrant` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discount` int(2) NOT NULL,
  `video` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `is_new`, `is_good_buy`, `sort`, `name`, `article`, `warrant`, `price`, `discount`, `video`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `short_description`, `description`) VALUES
(1, 5, 1, 1, 1, 0, 'Преобразователь напряжения с 24/12V (автомобильный) 10A **', 'NF-12/24V-10A', '1 год', 939, 0, '', '', '', '', 'preobrazovatel-napryazheniya-s-24-12v-avtomobilnyj-10a', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(2, 5, 1, 0, 1, 0, 'Инвертор напряжения автомобильный 24/220V 1000W, 2 розетки, 1 USB-порт', 'NF-24/220V-1000W', '1 год', 3899, 0, '', '', '', '', 'invertor-napryazheniya-avtomobilnyj-24-220v-1000w-2-rozetki-1-usb-port', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(3, 5, 1, 1, 0, 0, 'Инвертор напряжения автомобильный 24/220V 1500W **', 'NF-12/220V-1500W', '1 год', 4749, 0, '', '', '', '', 'invertor-napryazheniya-avtomobilnyj-24-220v-1500w', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(4, 10, 1, 1, 0, 1, 'Шакл для крепления буксирного троса и блоков лебёдки (серьга) 23 мм (7/8`) `Серия90-120`', '7\\8', '1 год', 459, 0, '', '', '', '', 'shakl-dlya-krepleniya-buksirnogo-trosa-i-blokov-lebyodki-serga-23-mm-7-8-seriya90-120', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(5, 10, 1, 1, 1, 2, 'Шакл для крепления буксирного троса и блоков лебёдки (серьга) 20 мм (3/4`), до 4,75 тонн `redBTR`', 'RB-Shakle-3/4', '1 год', 469, 0, '', '', '', '', 'shakl-dlya-krepleniya-buksirnogo-trosa-i-blokov-lebyodki-serga-20-mm-3-4-do-4-75-tonn-redbtr', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(6, 10, 1, 0, 1, 0, 'Шакл для крепления буксирного троса и блоков лебёдки (серьга) 16 мм (5/8`) `redBTR`', 'RB-Shakle-5/8', '1 год', 409, 0, '', '', '', '', 'shakl-dlya-krepleniya-buksirnogo-trosa-i-blokov-lebyodki-serga-16-mm-5-8-redbtr', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', '');

-- --------------------------------------------------------

--
-- Структура таблицы `recommended_products`
--

CREATE TABLE IF NOT EXISTS `recommended_products` (
  `product1_id` int(11) DEFAULT NULL,
  `product2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `recommended_products`
--

INSERT INTO `recommended_products` (`product1_id`, `product2_id`) VALUES
(NULL, 4),
(1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `sells_services`
--

CREATE TABLE IF NOT EXISTS `sells_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `sells_services`
--

INSERT INTO `sells_services` (`id`, `name`, `description`, `region`) VALUES
(1, 'Сериви-1', '', 'as'),
(2, 'Сервис-2', NULL, 'ch');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `order_string` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `main_title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `site_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_offline` int(11) DEFAULT '0',
  `offline_text` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `main_page_type` int(11) NOT NULL DEFAULT '1',
  `main_page_id` int(11) NOT NULL,
  `main_page_cat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `order_string`, `main_title`, `description`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'RedBTR', 'info@redBTR.ru', 'admin', '', 'Продукция от компании redBTR', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>', '', '', 0, '', 2, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patronymic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `house` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `building` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `apartment` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `valid_email` tinyint(1) NOT NULL DEFAULT '0',
  `vk_uid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vk_avatar` text COLLATE utf8_unicode_ci,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `last_name`, `name`, `patronymic`, `password`, `email`, `phone`, `city`, `street`, `house`, `building`, `apartment`, `zip_code`, `valid_email`, `vk_uid`, `vk_avatar`, `secret`) VALUES
(33, 'Лукинский', 'admin', 'Юръевич', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '', '', '', '', '', '', '', 0, NULL, NULL, ''),
(38, '', 'admin_2', '', '21232f297a57a5a743894a0e4a801fc3', 'admin_2@admin.ru', '', 'Санкт-Петербург', 'Руднева', '6', '1', '166', '', 0, NULL, NULL, ''),
(43, '', 'l666', '', 'fae0b27c451c728867a567e8c1bb4e53', 'l666@admin.ru', '', '', '', '', '', '', '', 1, NULL, NULL, ''),
(50, 'Лукинский', 'Паша', '', '', '', '', '', '', '', '', '', '', 0, 'vk-439844', 'http://cs617419.vk.me/v617419844/1427e/ZRxl2-Ez8sI.jpg', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users2users_groups`
--

CREATE TABLE IF NOT EXISTS `users2users_groups` (
  `group_parent_id` int(11) NOT NULL,
  `child_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users2users_groups`
--

INSERT INTO `users2users_groups` (`group_parent_id`, `child_id`) VALUES
(1, '33'),
(3, '33'),
(3, '38'),
(2, '43');

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_edit` int(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `is_edit`, `is_delete`) VALUES
(1, 'admin', 0, 0),
(2, 'customers', 0, 0),
(3, 'subscribers', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
