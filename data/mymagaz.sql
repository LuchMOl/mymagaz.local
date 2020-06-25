-- MySQL dump 10.13  Distrib 5.5.53, for Win64 (AMD64)
--
-- Host: localhost    Database: mymagaz
-- ------------------------------------------------------
-- Server version	5.5.53-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `top_menu` tinyint(1) NOT NULL DEFAULT '0',
  `rank` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `activity` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3481 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Женское белье',3088,1,98,1),(2,'Купальники',3088,1,100,1),(3,'Мужчинам',3094,0,20,1),(4,'Комплекты белья',1,0,25,1),(5,'Бюстгальтеры',1,1,90,1),(6,'Балконет',5,0,8,1),(7,'Push up',5,0,12,1),(8,'Уплотнённая чашка',5,0,10,1),(9,'Мягкая чашка',5,0,9,1),(10,'Трусики',1,1,88,1),(11,'Беременным',10,0,0,1),(12,'Стринги',10,0,5,1),(13,'Шортики',10,0,3,1),(14,'Cлипы',10,0,4,1),(15,'Кофточки, блузки, свитера',19,0,18,1),(18,'Пояса, подвязки',1,0,14,1),(19,'Женская одежда',3088,1,80,1),(20,'Боди, корсеты',1,0,19,1),(21,'Ожидают поступления',0,0,0,1),(22,'Корсеты, бюстье, корсажи',1,0,20,0),(23,'Последний размер',149,0,0,1),(24,'Купальники раздельные',2,0,50,1),(25,'Купальники слитные',2,0,40,1),(26,'Мужское бельё',3,1,100,1),(27,'Носки',3,1,5,1),(29,'Плавки, шорты  ',3,1,80,1),(30,'Пляжная одежда',163,0,9,1),(33,'Домашняя одежда',3,1,90,1),(42,'Невидимка',5,0,13,1),(45,'Бретельки, вкладыши',1,0,0,1),(47,'Колготки, чулки',3088,1,75,1),(52,'Подарочные сертификаты',0,0,0,0),(53,'Чулки',47,0,15,1),(54,'Колготки',47,0,20,1),(55,'8 марта',52,0,0,0),(56,'День святого Валентина',52,0,0,0),(57,'День Свадьбы',52,0,0,0),(58,'Годовщина свадьбы',52,0,0,0),(59,'Годовщина знакомства',52,0,0,0),(60,'Люблю',52,0,0,0),(61,'Просто подарок',52,0,0,0),(62,'С именинами',52,0,0,0),(63,'С юбилеем',52,0,0,0),(64,'С профессиональным праздником',52,0,0,0),(65,'Скорейшего выздоровления',52,0,0,0),(66,'В знак примирения',52,0,0,0),(68,'Оригинальные подарки',0,0,0,0),(69,'Фруктовые букеты',68,0,1,0),(70,'Красота',0,0,0,0),(72,'Уход за волосами',70,0,0,0),(73,'Шампуни',72,0,0,0),(74,'Бальзамы',72,0,0,0),(75,'Лечебные средства',72,0,0,0),(76,'Для прически',72,0,0,0),(77,'Уход за полостью рта',70,0,0,0),(78,'Домашнее хозяйство',0,0,0,0),(79,'Порошки',78,0,0,0),(80,'Средства для дополнительной обработки тканей',78,0,0,0),(81,'Мульти очистка',78,0,0,0),(82,'Чистящие средства специального назначения',78,0,0,0),(83,'Дополнительные средства для уборки дома',78,0,0,0),(84,'Средства для мытья посуды',78,0,0,0),(85,'Средства по уходу за кожей для мужчин',70,0,0,0),(87,'Новинки',121,0,0,0),(88,'Для пресетов',0,0,0,0),(89,'Подарочные наборы',88,0,1,0),(90,'Корректирующее белье',1,0,17,1),(91,'Категории стоков',0,0,0,0),(92,'Мужское бельё',91,0,0,0),(94,'Корсетное бельё',91,0,0,1),(95,'Соблазнительное белье',1,0,16,1),(98,'Деткам',3094,0,10,1),(99,'Для мальчиков',98,0,1,0),(100,'Детские бодики',98,1,1,0),(101,'Для девочек',98,1,2,0),(103,'Украшения',0,0,1,0),(104,'Гарнитуры',103,0,2,0),(105,'Кольца',103,0,5,0),(107,'Подвески',103,0,3,0),(108,'Колье',103,0,4,0),(110,'Браслеты',103,0,7,0),(112,'Для мужчин',103,0,1,0),(113,'Перстни',112,0,0,0),(114,'Браслеты',112,0,0,0),(115,'Серьги',103,0,6,0),(117,'Шляпы, панамы',163,0,8,1),(118,'Пляжная обувь',163,0,7,1),(119,'На пляж',98,0,5,1),(121,'Для неё',0,0,30,1),(122,'Подарочные наборы',121,0,1,0),(123,'Подарочные сертификаты',149,0,0,1),(130,'Пижамы, костюмы',160,0,5,1),(132,'Сорочки, пеньюары',160,0,4,1),(133,'Халаты, накидки',160,0,3,1),(134,'Майки, футболки, топы',19,0,1,1),(135,'Тапочки для дома',160,0,1,1),(136,'Бразилианы',10,0,4,1),(137,'Аксессуары',3,1,6,0),(138,'Пляжные полотенца',163,0,5,1),(139,'Спортивное',1,0,12,1),(140,'Гетры, гольфы',47,0,10,1),(141,'Пляжные сумки',163,0,6,1),(142,'Для спорта',121,0,0,0),(143,'Беременным и кормящим',121,0,0,0),(144,'Соблазнительное белье',121,0,0,0),(145,'Антицеллюлитное',121,0,0,0),(147,'Летнее белье',121,0,0,0),(148,'Хлопковое',121,0,0,0),(149,'Распродажа магазина',0,0,0,1),(150,'Товары с дефектом',149,0,0,1),(154,'Пляжные наборы',121,0,0,0),(155,'Домашний текстиль',149,0,0,0),(157,'Push up двойной',5,0,11,1),(158,'Платья, туники, юбки',19,0,19,1),(159,'Костюмы ,брюки, шорты',19,0,20,1),(160,'Домашняя одежда',19,1,88,1),(161,'Верхняя одежда',19,0,0,1),(163,'Для пляжа',3088,1,99,1),(164,'Купальники',149,0,0,1),(165,'Для пляжа',149,0,0,1),(166,'Женское белье',149,0,0,1),(167,'Женская одежда',149,0,0,1),(168,'Сорочки, пижамы, халатики',149,0,0,1),(169,'Чулки, колготки',149,0,0,1),(170,'Деткам',149,0,0,0),(171,'Мужское',149,0,0,1),(174,'Верх купальника',2,0,10,1),(175,'Плавки',2,0,6,1),(178,'Платья, туники, халаты',30,0,2,1),(179,'Майки, топы, футболки',30,0,3,1),(180,'Юбки, парео',30,0,1,1),(181,'(OLD)_Комбидресс',1,0,0,0),(182,'Брюки, шорты',30,0,4,1),(183,'Леггинсы',47,0,0,1),(3004,'Для подростков',98,1,3,0),(3005,'Носочки',47,0,0,1),(3007,'Шапки, шарфы, куртки',19,0,17,1),(3009,'Одежда',3,1,25,1),(3010,'Футболки, поло, майки',3009,0,0,1),(3012,'Кофты с рукавом, куртки',3009,0,0,1),(3013,'Брюки, штаны, шорты',3009,0,0,1),(3014,'Спортивная одежда',3009,0,0,1),(3017,'Трусы слип',26,0,9,1),(3018,'(OLD) Футболки, майки',26,0,4,0),(3020,'Наборы белья',26,0,5,0),(3021,'Термобельё',3,1,85,1),(3022,'Трусы boxer',26,0,8,1),(3025,'Маски защитные',19,0,87,1),(3026,'Юбки',19,0,0,0),(3027,'Одежда',91,0,0,1),(3028,'Аксессуары',91,0,0,0),(3029,'Обувь',91,0,0,0),(3030,'Колготы и носки',91,0,0,1),(3032,'Трикотаж',91,0,0,1),(3033,'Купальники и пляжная одежда',91,0,0,1),(3034,'Пижамы',91,0,0,1),(3035,'Трусы',91,0,0,1),(3041,'(OLD)_Майки, футболки, кофточки',160,0,0,0),(3043,'Купальники монокини',2,0,30,0),(3048,'(OLD)_Термобельё',19,0,0,0),(3049,'Подарки по случаю',0,0,0,1),(3052,'Термобельё',1,0,0,1),(3056,'День Св. Николая',3049,0,0,1),(3057,'Подарки для девочек',3056,0,4,1),(3058,'Подарки женщинам',3056,0,2,1),(3059,'Подарки мужчинам',3056,0,1,1),(3060,'15 бюджетных идей подарка',3049,0,0,1),(3061,'Для женщин',3060,0,0,1),(3062,'Для мужчин',3060,0,0,1),(3063,'Для деток',3060,0,0,1),(3065,'Для него',3090,0,0,1),(3067,'Для неё',3090,0,0,1),(3068,'Подарки любимой на Новый год',3067,0,0,1),(3069,'Подарки для подруги, сестры на Новый год',3067,0,0,1),(3070,'Подарки для мамы на Новый год ',3067,0,0,1),(3071,'Тёплые подарки',3065,0,0,1),(3072,'Практичные подарки',3065,0,0,1),(3073,'Подарки с заботой',3065,0,0,1),(3074,'Подарки для мальчиков',3056,0,3,1),(3075,'Сексуальные',3067,0,0,1),(3076,'Красивые',3067,0,0,1),(3077,'Тёплые',3067,0,0,1),(3078,'Элитные',3067,0,0,1),(3080,'В цвет 2017 года',3067,0,0,1),(3081,'Подарки Любимому на Новый год',3065,0,0,1),(3082,'Подарки для друга, брата на Новый год',3065,0,0,1),(3083,'Подарки для папы на Новый год',3065,0,0,1),(3086,'Для девушки',3089,0,0,1),(3087,'Для мужчины',3089,0,0,0),(3088,'Женщинам',3094,0,112,1),(3089,'14 февраля',0,0,0,0),(3090,'Новый Год',0,0,0,1),(3094,'КАТАЛОГ ТОВАРОВ',0,0,114,1),(3096,'8 марта',3049,0,0,1),(3097,'Девушке',3096,0,0,1),(3098,'Подруге',3096,0,0,1),(3099,'Маме',3096,0,0,1),(3100,'Трусы семейные',26,0,6,1),(3101,'Свадебные платья и аксессуары',19,0,0,0),(3102,'Свадебные платья',149,0,0,1),(3103,'Комплекты белья',3101,0,0,1),(3104,'Красивые бретели',3101,0,0,1),(3105,'Пояса, подвязки',3101,0,0,1),(3106,'Чулки',3101,0,0,1),(3107,'Пеньюары и халатики',3101,0,0,1),(3111,'Свадебные платья',149,0,0,0),(3112,'Спортивная одежда',19,0,0,1),(3114,'АКЦИЯ -60%',149,0,14,0),(3115,'АКЦИЯ -50%',149,0,13,0),(3116,'АКЦИЯ -40%',149,0,12,0),(3117,'Всё по 1000 руб.',149,0,0,0),(3118,'Всё по 500 руб.',149,0,0,0),(3119,'Тапочки',19,0,0,0),(3120,'Купальники танкини',2,0,20,0),(3121,'Пляжная обувь',3,1,70,1),(3122,'Розетка',0,0,0,0),(3123,'Эротическое белье',3122,0,0,0),(3124,'Женские ночные рубашки',3122,0,0,0),(3125,'Женские комбинезоны',3122,0,0,0),(3126,'Женские шорты',3122,0,0,0),(3127,'Женские кофты',3122,0,0,0),(3128,'Женские джемперы',3122,0,0,0),(3129,'Женские свитшоты',3122,0,0,0),(3130,'Женские платья',3122,0,0,0),(3131,'Женские сарафаны',3122,0,0,0),(3132,'Женские следы',3122,0,0,0),(3133,'Женские носки',3122,0,0,0),(3134,'Женские туники',3122,0,0,0),(3135,'Женская пляжная одежда',3122,0,0,0),(3136,'Женская домашняя одежда',3122,0,0,0),(3137,'Женские футболки',3122,0,0,0),(3138,'Женские брюки',3122,0,0,0),(3139,'Женские леггинсы',3122,0,0,0),(3140,'Лосины для малышей',3122,0,0,0),(3141,'Женские майки',3122,0,0,0),(3142,'Женские комбидрессы',3122,0,0,0),(3143,'Женские халаты',3122,0,0,0),(3144,'Женские пижамы',3122,0,0,0),(3145,'Женские юбки',3122,0,0,0),(3146,'Женские блузы',3122,0,0,0),(3147,'Женские футболки с длинными рукавами',3122,0,0,0),(3148,'Женское пончо',3122,0,0,0),(3149,'Мужская домашняя одежда',3122,0,0,0),(3150,'Мужские футболки',3122,0,0,0),(3151,'Мужские халаты',3122,0,0,0),(3152,'Мужские поло',3122,0,0,0),(3153,'Женские толстовки',3122,0,0,0),(3154,'Мужские тенниски',3122,0,0,0),(3155,'Мужские майки',3122,0,0,0),(3156,'Мужские гетры',3122,0,0,0),(3157,'Мужские носки',3122,0,0,0),(3158,'Мужские следы',3122,0,0,0),(3159,'Мужские водолазки',3122,0,0,0),(3160,'Пляжные шорты и плавки',3122,0,0,0),(3161,'Мужские джемперы',3122,0,0,0),(3162,'Женские гольфы',3122,0,0,0),(3163,'Джемперы для малышей',3122,0,0,0),(3164,'Женские спортивные топы',3122,0,0,0),(3165,'Женские спортивные леггинсы',3122,0,0,0),(3166,'Женские спортивные капри',3122,0,0,0),(3167,'Женские спортивные майки',3122,0,0,0),(3168,'Женские спортивные топы',3122,0,0,0),(3169,'Женские спортивные штаны',3122,0,0,0),(3170,'Мужские спортивные кофты',3122,0,0,0),(3171,'Мужские рашгарды',3122,0,0,0),(3172,'Мужские спортивные костюмы',3122,0,0,0),(3173,'Женские костюмы',3122,0,0,0),(3174,'Корсеты, бюстье',3122,0,0,0),(3175,'Женские комнатные тапочки',3122,0,0,0),(3176,'Мужские пижамы',3122,0,0,0),(3177,'Женские кардиганы',3122,0,0,0),(3178,'Пляжная одежда',3122,0,0,0),(3179,'Женские пуловеры',3122,0,0,0),(3181,'(OLD)_Майка и трусики',1,0,0,0),(3299,'Перчатки и варежки',3122,0,0,0),(3300,'Мужские вьетнамки, сланцы',3122,0,0,0),(3301,'Женские вьетнамки, сланцы',3122,0,0,0),(3302,'Женские чулки',3122,0,0,0),(3303,'Носки для мальчиков',3122,0,0,0),(3304,'Женские водолазки',3122,0,0,0),(3305,'Специально к Halloween',121,0,0,1),(3306,'Для него',0,0,0,1),(3307,'Подборка к Halloween',3306,0,0,0),(3308,'Специально к Halloween',3306,0,0,0),(3309,'Страшно модный браллет — тренд года 2018/19',121,0,0,1),(3310,'Белье для беременных и кормящих мам',3122,0,0,0),(3311,'Детское нижнее бельё',3122,0,0,0),(3312,'Женские топы',3122,0,0,0),(3313,'Женские полукомбинезоны',3122,0,0,0),(3314,'Женские джинсы',3122,0,0,0),(3315,'Купальники',21,0,0,0),(3316,'Для пляжа',21,0,0,0),(3317,'Чулки, колготки',21,0,0,0),(3318,'Плюшевое очарование — тренд года 2018/19',121,0,0,1),(3319,'Подборка праздничных товаров от Intimo со скидкой 20%',121,0,0,0),(3320,'Мужские рубашки',3122,0,0,0),(3321,'Женские худи',3122,0,0,0),(3322,'Мужские толстовки',3122,0,0,0),(3323,'Женские спортивные шорты',3122,0,0,0),(3324,'Детские носки',3122,0,0,0),(3325,'Мужские тайтсы',3122,0,0,0),(3326,'Мужские спортивные штаны',3122,0,0,0),(3327,'Мужские брюки',3122,0,0,0),(3328,'Купальники',3122,0,0,0),(3329,'Детское термобелье',3122,0,0,0),(3330,'Термобельё',3122,0,0,0),(3331,'Соблазнительное белье',3122,0,0,0),(3332,'Женские жакеты',3122,0,0,0),(3333,'Корсеты, бюстье',3122,0,0,0),(3334,'Идеи мужских подарков к Дню влюбленных',3306,0,0,1),(3335,'Идеи подарков любимым женщинам к 14 февраля',121,0,0,1),(3336,'Туника+леггинсы',3122,0,0,0),(3337,'Элитный подарок для самой роскошной ',121,0,0,1),(3338,'Сексуальный подарок для самой желанной',121,0,0,1),(3339,'Уютный подарок для самой любимой',121,0,0,1),(3340,'Детское термобелье',3122,0,0,0),(3341,'Женские жилеты',3122,0,0,0),(3342,'Комплекты для малышей',3122,0,0,0),(3343,'Песочники для малышей',3122,0,0,0),(3344,'Костюмы для малышей',3122,0,0,0),(3345,'Платья для девочек',3122,0,0,0),(3346,'Подарки дорогим мамочкам',121,0,0,1),(3347,'Малышам',98,1,80,1),(3348,'Бодики, песочники',3347,0,0,1),(3349,'Платья для принцесс',3347,0,0,1),(3350,'Костюмы, комплекты',3347,0,0,1),(3351,'Штаны, шорты',3347,0,0,1),(3352,'Для девочек',98,1,100,1),(3353,'Платья, юбки',3352,0,60,1),(3354,'Брюки, шорты',3352,0,0,1),(3355,'Костюмы, комплекты',3352,0,0,1),(3357,'Журнал VOUGUE рекомендует купальники Ysabel Mora',121,0,0,1),(3358,'Верхняя одежда',3352,0,0,1),(3359,'Термобельё девочкам',3352,1,50,1),(3360,'Футболки, майки',3352,0,0,1),(3361,'Кофты, свитера',3352,0,0,1),(3362,'Нижнее белье',3352,0,0,1),(3363,'Домашняя одежда',3352,0,0,1),(3364,'Для мальчиков',98,1,90,1),(3365,'Костюмы, комплекты',3364,0,0,1),(3366,'Домашняя одежда',3364,0,0,0),(3367,'Термобельё мальчикам',3364,1,40,1),(3368,'Нижнее белье',3364,0,0,1),(3369,'Верхняя одежда',3364,0,0,1),(3370,'Кофты, футболки',3364,0,0,1),(3371,'Штаны, шорты',3364,0,0,1),(3372,'На пляж',3364,0,0,1),(3373,'На пляж',3352,0,0,1),(3374,'Обувь',3347,0,0,1),(3376,'ТОП 10 купальников INTIMO',121,0,0,1),(3377,'ТОП 10 одежды для пляжа INTIMO',121,0,0,1),(3378,'ТОП 10 слитных купальников INTIMO',121,0,0,1),(3379,'Самые красивые купальники для загара',121,0,0,1),(3380,'Пляжные аксессуары',163,0,0,1),(3381,'Человечки для мальчиков',3122,0,0,0),(3382,'Поло для мальчиков',3122,0,0,0),(3383,'Человечки для девочек',3122,0,0,0),(3384,'Куртки для девочек',3122,0,0,0),(3385,'Шапочки для мальчиков',3122,0,0,0),(3386,'Шапочки для девочек',3122,0,0,0),(3387,'Лосины для девочек',3122,0,0,0),(3388,'Женские топы',3122,0,0,0),(3390,'Аксессуары',19,0,0,1),(3391,'Кошельки и клатчи',3390,0,0,1),(3392,'Сумки и рюкзаки',3390,0,0,1),(3393,'Чемоданы',3390,0,0,1),(3394,'Женские трусы',3122,0,0,0),(3395,'Пояса и подвязки',3122,0,0,0),(3396,'Майки, топы',3122,0,0,0),(3397,'Пинетки',3122,0,0,0),(3398,'Слюнявчики и нагрудники',3122,0,0,0),(3399,'Детские пижамы',3122,0,0,0),(3400,'Пинетки',3122,0,0,0),(3401,'Носочки',3352,0,0,0),(3402,'Носки',3364,0,0,0),(3403,'Женские кардиганы',3122,0,0,0),(3404,'Женские бомберы',3122,0,0,0),(3405,'Комплект нижнего белья',3122,0,0,0),(3406,'Мужская шапка',3122,0,0,0),(3407,'Мужской шарф',3122,0,0,0),(3408,'Женские спортивные футболки',3122,0,0,0),(3409,'Мешки для стирки',3122,0,0,0),(3410,'Аксессуары для детей',3122,0,0,0),(3411,'Парео',3122,0,0,0),(3412,'Костюмы для малышей',3122,0,0,0),(3413,'Куртки для мальчиков',3122,0,0,0),(3414,'Комплект для девочки',3122,0,0,0),(3415,'Топ подростковый',3122,0,0,0),(3416,'Пуловер и сорочка',3122,0,0,0),(3417,'Водолазки для девочек',3122,0,0,0),(3418,'Лосины для малышей',3122,0,0,0),(3419,'Женские джинсы',3122,0,0,0),(3420,'Детские носки',3122,0,0,0),(3421,'Мужские пижамы',3122,0,0,0),(3422,'Мужские шорты',3122,0,0,0),(3423,'Топы и бюстгальтеры для девочек',3122,0,0,0),(3424,'Костюмы для девочек',3122,0,0,0),(3425,'Пижамы для малышей',3122,0,0,0),(3426,'Женские спортивные костюмы',3122,0,0,0),(3427,'Женские пуловеры',3122,0,0,0),(3428,'Мужские трусы',3122,0,0,0),(3429,'Леггинсы для девочек',3122,0,0,0),(3430,'Женские гетры',3122,0,0,0),(3431,'Женские колготки',3122,0,0,0),(3432,'Свадебные платья',3122,0,0,0),(3433,'Жакеты для девочек',3122,0,0,0),(3434,'Пинетки для девочек',3122,0,0,0),(3435,'Бюстгальтеры',3122,0,0,0),(3436,'Шапки и шарфы',3009,0,0,1),(3437,'Яркие принты',10,0,0,1),(3438,'Яркие принты',26,0,0,0),(3439,'Кофты для девочек',3122,0,0,0),(3440,'Джинсы для девочек',3122,0,0,0),(3441,'Брюки для девочек',3122,0,0,0),(3442,'Майки бельевые для девочек',3122,0,0,0),(3443,'Майки бельевые для девочек',3122,0,0,0),(3444,'Пижамы для девочек',3122,0,0,0),(3445,'Сарафаны для девочек',3122,0,0,0),(3446,'Комбинезоны для девочек',3122,0,0,0),(3447,'Жакеты для девочек',3122,0,0,0),(3448,'Купальники для девочек',3122,0,0,0),(3449,'Полотенца-пончо для девочек',3122,0,0,0),(3450,'Куртки для девочек',3122,0,0,0),(3451,'Спортивные костюмы для девочек',3122,0,0,0),(3452,'Ночные рубашки для девочек',3122,0,0,0),(3453,'Плавки для девочек',3122,0,0,0),(3454,'Майки бельевые для мальчиков',3122,0,0,0),(3455,'Шорты для мальчиков',3122,0,0,0),(3456,'Джемперы для мальчиков',3122,0,0,0),(3457,'Брюки для мальчиков',3122,0,0,0),(3458,'Комплекты для мальчиков',3122,0,0,0),(3459,'Поло для мальчиков',3122,0,0,0),(3460,'Пальто для мальчиков',3122,0,0,0),(3461,'Спортивные костюмы для мальчиков',3122,0,0,0),(3462,'Полотенца-пончо для мальчиков',3122,0,0,0),(3463,'Плавки для мальчиков',3122,0,0,0),(3464,'Куртки для мальчиков',3122,0,0,0),(3465,'Юбки для девочек',3122,0,0,0),(3466,'Платья для девочек',3122,0,0,0),(3467,'Детские гетры',3122,0,0,0),(3468,'Костюмы для мальчиков',3122,0,0,0),(3469,'Шорты для мальчиков',3122,0,0,0),(3470,'Спортивные штаны для мальчиков',3122,0,0,0),(3471,'Комнатные тапки для мальчиков',3122,0,0,0),(3472,'Пижамы для мальчиков',3122,0,0,0),(3473,'Женские ветровки',3122,0,0,0),(3474,'Боди',3122,0,0,0),(3475,'Шлепанцы для девочек',3122,0,0,0),(3476,'Пляжные шорты и плавки',3122,0,0,0),(3477,'Ремни и пояса',3122,0,0,0),(3478,'Головные уборы',3122,0,0,0),(3479,'Сумки',3122,0,0,0),(3480,'Комплекты новые тест',4,0,0,1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colours`
--

DROP TABLE IF EXISTS `colours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colours` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `colour` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colours`
--

LOCK TABLES `colours` WRITE;
/*!40000 ALTER TABLE `colours` DISABLE KEYS */;
INSERT INTO `colours` VALUES (1,'black'),(2,'red'),(3,'brown'),(4,'blue');
/*!40000 ALTER TABLE `colours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `product_id` smallint(5) unsigned NOT NULL,
  `category_id` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (9,1),(9,2),(10,3),(11,1),(11,2),(12,1),(12,2),(12,3),(13,1),(13,2),(14,4);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colour_quantity`
--

DROP TABLE IF EXISTS `product_colour_quantity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_colour_quantity` (
  `product_id` smallint(5) unsigned NOT NULL,
  `colour_id` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_colour_quantity`
--

LOCK TABLES `product_colour_quantity` WRITE;
/*!40000 ALTER TABLE `product_colour_quantity` DISABLE KEYS */;
INSERT INTO `product_colour_quantity` VALUES (9,1),(9,2),(10,3),(11,1),(11,2),(11,3),(12,1),(12,2),(12,3),(13,1),(13,2),(13,3),(14,2);
/*!40000 ALTER TABLE `product_colour_quantity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Товары';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (9,'chair','cougar','150-60-60','the best of chairs','a:1:{i:0;s:18:\"5ed3574281af60.png\";}'),(10,'sofa','kall','110-220-80','Shmat kalla','a:1:{i:0;s:18:\"5ed357a7d94830.png\";}'),(11,'king','dx-racer','150-80-80','king size dx-racer','a:3:{i:0;s:18:\"5ed3582258dd80.png\";i:1;s:18:\"5ed3582258dd81.png\";i:2;s:18:\"5ed35822591c02.png\";}'),(12,'вапр','пвар','вапр','впра','a:3:{i:0;s:18:\"5ed3eea43a0cf0.png\";i:1;s:18:\"5ed3eea43a0cf1.png\";i:2;s:18:\"5ed3eea43a4b72.png\";}'),(13,'aaaa','aaaaa','aaaaa','aaaa','a:1:{i:0;s:18:\"5ed3f097944690.png\";}'),(14,'dfghf','ghfghf','gdhfgd','hfgdh','a:1:{i:0;s:18:\"5ed3f0b4ef4310.png\";}');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_user`
--

DROP TABLE IF EXISTS `session_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_user` (
  `user_id` int(10) DEFAULT NULL,
  `session_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `session_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_user`
--

LOCK TABLES `session_user` WRITE;
/*!40000 ALTER TABLE `session_user` DISABLE KEYS */;
INSERT INTO `session_user` VALUES (4,'usiss1iv0osr1hu967bfssldl3');
/*!40000 ALTER TABLE `session_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_user_test`
--

DROP TABLE IF EXISTS `session_user_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_user_test` (
  `user_id` int(10) DEFAULT NULL,
  `session_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `session_user_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `test` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_user_test`
--

LOCK TABLES `session_user_test` WRITE;
/*!40000 ALTER TABLE `session_user_test` DISABLE KEYS */;
INSERT INTO `session_user_test` VALUES (1,'783eudd3dtvsn3dh2mtsp5i483'),(2,'kh7m7k02boahk0st8nlnjfvv37'),(3,'kh7m7k02boahk0st8nlnjfvv37');
/*!40000 ALTER TABLE `session_user_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'admin@mymagaz.local','admin','admin'),(2,'user@mymagaz.local','user','user'),(3,'test@mymagaz.local','test','test');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top_menu`
--

DROP TABLE IF EXISTS `top_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top_menu`
--

LOCK TABLES `top_menu` WRITE;
/*!40000 ALTER TABLE `top_menu` DISABLE KEYS */;
INSERT INTO `top_menu` VALUES (1,20),(2,NULL),(3,NULL),(4,2),(5,28);
/*!40000 ALTER TABLE `top_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (0,'admin@mymagaz.local','admin','admin'),(1,'user@mymagaz.local','user','user'),(2,'guest@mymagaz.local','guest','guest'),(3,'test@mymagaz.local','test','test'),(4,'vasa','jopa','pupkin'),(5,'vasa','jopa','pupkin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@mymagaz.local','admin','admin'),(2,'user@mymagaz.local','user','user'),(3,'guest@mymagaz.local','guest','guest'),(4,'test@mymagaz.local','test','test');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-25 16:51:16
