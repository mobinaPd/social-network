DROP database IF EXISTS sadaf;

create database sadaf char set utf8 collate utf8_persian_ci;

use sadaf;

DROP TABLE IF EXISTS sadaf.AccountSpecs;
CREATE TABLE  sadaf.AccountSpecs (
                                     AccountSpecID int(11) NOT NULL AUTO_INCREMENT,
                                     UserID varchar(100) CHARACTER SET latin1 NOT NULL UNIQUE ,
                                     UserPassword varchar(100) CHARACTER SET utf8 NOT NULL ,
                                     UserEmail varchar(100) CHARACTER SET utf8 DEFAULT NULL UNIQUE ,
                                     PersonID int(11) NOT NULL,
                                     Status varchar(30) CHARACTER SET utf8 DEFAULT NULL,
                                     StartDate TIMESTAMP ,
                                     PRIMARY KEY (AccountSpecID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

COMMIT;

DROP TABLE IF EXISTS sadaf.EMonArray;
CREATE TABLE  sadaf.EMonArray (
                                  _id int(11) NOT NULL,
                                  emon int(11) DEFAULT NULL,
                                  PRIMARY KEY (_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.FacilityPages;
CREATE TABLE  sadaf.FacilityPages (
                                      FacilityPageID int(11) NOT NULL AUTO_INCREMENT,
                                      FacilityID int(11) DEFAULT NULL,
                                      PageName varchar(145) COLLATE utf8_persian_ci DEFAULT NULL,
                                      PRIMARY KEY (FacilityPageID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;



DROP TABLE IF EXISTS sadaf.FMonArray;
CREATE TABLE  sadaf.FMonArray (
                                  _id int(11) NOT NULL,
                                  fmon int(11) DEFAULT NULL,
                                  PRIMARY KEY (_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.persons;
CREATE TABLE  sadaf.persons (
                                PersonID int(11) NOT NULL AUTO_INCREMENT,
                                pfname varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
                                plname varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
                                CardNumber varchar(45) CHARACTER SET latin1 DEFAULT NULL,
                                PRIMARY KEY (PersonID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.SysAudit;
CREATE TABLE  sadaf.SysAudit (
                                 RecID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                 UserID varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
                                 ActionType tinyint(3) unsigned DEFAULT NULL,
                                 ActionDesc varchar(500) COLLATE utf8_persian_ci DEFAULT NULL,
                                 IPAddress bigint(20) DEFAULT NULL,
                                 SysCode tinyint(3) unsigned DEFAULT NULL,
                                 IsSecure tinyint(3) unsigned DEFAULT NULL,
                                 ATS timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                 PRIMARY KEY (RecID),
                                 KEY UserID (UserID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.SystemDBLog;
CREATE TABLE  sadaf.SystemDBLog (
                                    RecID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                    page varchar(200) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'صفحه',
                                    query text COLLATE utf8_persian_ci COMMENT 'پرس و جو',
                                    SerializedParam text COLLATE utf8_persian_ci COMMENT 'پارامتر پرس و جو',
                                    UserID varchar(15) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'شناسه کاربر',
                                    IPAddress bigint(20) DEFAULT NULL COMMENT 'آدرس IP',
                                    SysCode tinyint(3) unsigned DEFAULT NULL COMMENT 'کد سیستم',
                                    ATS timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'تاریخ اجرا',
                                    ExecuteTime float(14,10) NOT NULL COMMENT 'مدت زمان اجرا',
                                    QueryStatus enum('SUCCESS','FAILED') COLLATE utf8_persian_ci DEFAULT 'SUCCESS' COMMENT 'وضعیت پرس و جو',
                                    DBName varchar(30) COLLATE utf8_persian_ci DEFAULT '' COMMENT 'نام پایگاه داده',
                                    PRIMARY KEY (RecID),
                                    KEY UserID (UserID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.SpecialPages;
CREATE TABLE  sadaf.SpecialPages (
                                     SpecialPageID int(11) NOT NULL AUTO_INCREMENT,
                                     PageName varchar(245) COLLATE utf8_persian_ci DEFAULT NULL,
                                     PRIMARY KEY (SpecialPageID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.SystemFacilities;
CREATE TABLE  sadaf.SystemFacilities (
                                         FacilityID int(11) NOT NULL AUTO_INCREMENT,
                                         FacilityName varchar(245) COLLATE utf8_persian_ci DEFAULT NULL,
                                         GroupID int(11) DEFAULT NULL,
                                         OrderNo int(11) DEFAULT NULL,
                                         PageAddress varchar(345) COLLATE utf8_persian_ci DEFAULT NULL,
                                         PRIMARY KEY (FacilityID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.SystemFacilityGroups;
CREATE TABLE  sadaf.SystemFacilityGroups (
                                             GroupID int(11) NOT NULL AUTO_INCREMENT,
                                             GroupName varchar(145) COLLATE utf8_persian_ci DEFAULT NULL,
                                             OrderNo int(11) DEFAULT NULL,
                                             PRIMARY KEY (GroupID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.UserFacilities;
CREATE TABLE  sadaf.UserFacilities (
                                       FacilityPageID int(11) NOT NULL AUTO_INCREMENT,
                                       UserID varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
                                       FacilityID int(11) DEFAULT NULL,
                                       PRIMARY KEY (FacilityPageID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

CREATE TABLE  sadaf.ManageStatus (
                                     FacilityStatusID int(11) NOT NULL AUTO_INCREMENT,
                                     FacilityName varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
                                     Status int(11) NOT NULL,
                                     PRIMARY KEY (FacilityStatusID)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.user;
CREATE TABLE sadaf.user (
                            username varchar(30)  NOT NULL,
                            userId int(15) NOT NULL AUTO_INCREMENT,
                            pass varchar(15)  NOT NULL,
                            email varchar(30)  NOT NULL,
                            PRIMARY KEY (userId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS sadaf.profile;
CREATE TABLE sadaf.profile (
                               username varchar(30)  NOT NULL,
                               userId int(15) NOT NULL,
                               name varchar(30)  DEFAULT NULL,
                               bio text DEFAULT NULL ,
                               profileimage varchar(40)  DEFAULT './profileImg/profile.png',
                               PRIMARY KEY (userId),
                               FOREIGN KEY (userId)
                                   REFERENCES user(userId)
                                   ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;


DROP TABLE IF EXISTS sadaf.follow;
CREATE TABLE sadaf.follow (
                              followingId int(15)  NOT NULL,
                              followedId int(15)  NOT NULL,
                              FOREIGN KEY (followingId)
                                  REFERENCES user(userId)
                                  ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;



DROP TABLE IF EXISTS sadaf.post;
CREATE TABLE sadaf.post (
                            username varchar(30)  NOT NULL,
                            userId int(15) NOT NULL,
                            postId int(30) NOT NULL AUTO_INCREMENT,
                            text text DEFAULT NULL,
                            image varchar(15) DEFAULT NULL,
                            date date NOT NULL,
                            PRIMARY KEY (postId),
                            FOREIGN KEY (userId)
                                REFERENCES user(userId)
                                ON DELETE CASCADE

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;


DROP TABLE IF EXISTS sadaf.comment;
CREATE TABLE sadaf.comment (
                               username varchar(30)  NOT NULL,
                               userId int(15) NOT NULL,
                               postId int(30) NOT NULL,
                               comment text(50) NOT NULL,
                               FOREIGN KEY (postId)
                                   REFERENCES post(postId)
                                   ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;



DROP TABLE IF EXISTS sadaf.likes;
CREATE TABLE sadaf.likes (
                             username varchar(30)  NOT NULL,
                             userId int(15) NOT NULL,
                             postId int(30) NOT NULL,
                             status int(1) DEFAULT 1,
                             FOREIGN KEY (postId)
                                 REFERENCES post(postId)
                                 ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;


DROP TABLE IF EXISTS sadaf.pwdReset;
CREATE TABLE sadaf.pwdReset (
                                pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                                pwdResetEmail text NOT NULL,
                                pwdResetSelector text NOT NULL,
                                pwdResetToken longtext NOT NULL,
                                pwdResetExpires text NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;


INSERT INTO user (username, userId,pass, email) VALUES
('mahdipasyegane',1 ,'mahdi1234', 'mahdipasyegane@gmail.com'),
('mobinapooladi', 2,'mobina1234', 'mobinapooladi@gmail.com'),
('amirroshandel', 3,'amir1234', 'amirroshandel@gmail.com'),
('matinkoohjani',4,'matin1234', 'matinkoohjani@gmail.com'),
('masudakhgar', 5,'masud1234', 'masudakhgar@gmail.com'),
('maryamhokmabadi',6, 'maryam1234', 'maryamhokmabadi@gmail.com'),
('omid', 7, 'omid3000', 'omid@gmail.com'),
('sarajalali', 8, '123456789', 'sarajalali@gmail.com'),
('alitalebi', 9, '123456789', 'alitalebi@gmail.com'),
('mohammad', 10, '123456789', 'moheti@gmail.com'),
('faridghari', 11, '123456789', 'faridghari@gmail.com'),
('atefearab', 12, '123456789', 'atefearab@gmail.com'),
('nazanin_t', 13, '123456789', 'nazanint@gmail.com'),
('alirezaabdi', 14, '123456789', 'alirezaabdi@gmail.com'),
('negin43', 15, '123456789', 'negin43@gmail.com'),
('sogandhashemi', 16, '123456789', 'sogandhashemi@gmail.com'),
('jenniferaniston', 17, '123456789', 'jenniferaniston@gmail.com'),
('barackobama', 18, '123456789', 'barackobama@gmail.com'),
('davidfincher', 19, '123456789', 'davidfincher@gmail.com'),
('paulwalker', 20, '123456789', 'paulwalker@gmail.com');



INSERT INTO profile (username, userId,name, bio) VALUES
('mahdipasyegane',1 ,'mahdi', 'hello im mahdi'),
('mobinapooladi',2, 'mobina', 'hello im mobina'),
('amirroshandel',3, 'amir', 'hello im amir'),
('matinkoohjani',4, 'matin', 'hello im matin'),
('masudakhgar',5, 'masud', 'hello im masud'),
('maryamhokmabadi', 6,'maryam', 'hello im maryam'),
('omid', 7, 'omid3000', 'hello im omid'),
('sarajalali', 8, 'sara', 'hello im sara'),
('alitalebi', 9, 'ali', 'hello im ali'),
('mohammad', 10, 'mohammad', 'hello im mohammad'),
('faridghari', 11, 'farid', 'hello im farid'),
('atefearab', 12, 'atefe', 'hello im atefe'),
('nazanin_t', 13, 'nazanin', 'hello im nazanin'),
('alirezaabdi', 14, 'alireza', 'hello im alireza'),
('negin43', 15, 'negin', 'hello im negin'),
('sogandhashemi', 16, 'sogand', 'hello im sogand'),
('jenniferaniston', 17, 'jennifer', 'hello im an actress'),
('barackobama', 18, 'barack', 'hello im formal president'),
('davidfincher', 19, 'david', 'hello im a director'),
('paulwalker', 20, 'paul', 'hello im dead');


INSERT INTO likes (username, userId, postId, status)  VALUES
('mobinapooladi',2,1,1),
('mobinapooladi',2,3,1),
('mobinapooladi',2,4,1),
('mahdipasyegane',1,4,1),
('mahdipasyegane',1,3,1),
('mahdipasyegane',1,2,1),
('amirroshandel',3,1,1),
('amirroshandel',3,2,1),
('amirroshandel',3,4,1),
('amirroshandel',3,5,1),
('matinkoohjani',4,1,1),
('matinkoohjani',4,2,1),
('matinkoohjani',4,3,1),
('matinkoohjani',4,5,1),
('matinkoohjani',4,6,1),
('masudakhgar',5,1,1),
('masudakhgar',5,2,1),
('masudakhgar',5,3,1),
('masudakhgar',5,4,1),
('maryamhokmabadi',6,4,1),
('omid',7,4,1),
('sarajalali',8,4,1),
('alitalebi',9,4,1),
('mohammad',10,4,1),
('faridghari',11,4,1),
('atefearab',12,4,1),
('nazanin_t',13,4,1),
('alirezaabdi',14,4,1),
('negin43',15,4,1),
('sogandhashemi',15,4,1),
('maryamhokmabadi',6,1,1),
('omid',7,4,1),
('sarajalali',8,1,1),
('alitalebi',9,1,1),
('mohammad',10,1,1),
('faridghari',11,1,1),
('atefearab',12,1,1),
('nazanin_t',13,1,1),
('alirezaabdi',14,1,1),
('negin43',15,1,1),
('sogandhashemi',15,1,1),
('maryamhokmabadi',6,2,1),
('omid',7,2,1),
('sarajalali',8,2,1),
('alitalebi',9,2,1),
('mohammad',10,2,1),
('faridghari',11,2,1),
('atefearab',12,2,1),
('nazanin_t',13,2,1),
('alirezaabdi',14,2,1),
('negin43',15,2,1),
('sogandhashemi',15,2,1),
('maryamhokmabadi',6,3,1),
('omid',7,3,1),
('sarajalali',8,3,1),
('alitalebi',9,3,1),
('mohammad',10,3,1),
('faridghari',11,3,1),
('atefearab',12,3,1),
('nazanin_t',13,3,1),
('alirezaabdi',14,3,1),
('negin43',15,3,1),
('sogandhashemi',15,3,1);

INSERT INTO follow (followingId, followedId) VALUES
('2', '1'),
('2', '3'),
('2', '4'),
('2', '8'),
('2', '9'),
('2', '10'),
('2', '4'),
('2','20'),
('1', '4'),
('1', '3'),
('1', '2'),
('1', '8'),
('1', '9'),
('1', '10'),
('1','19'),
('3', '1'),
('3', '4'),
('3', '5'),
('3', '2'),
('3', '8'),
('3', '9'),
('3', '10'),
('3','18'),
('4', '1'),
('4', '2'),
('4', '3'),
('4', '4'),
('4', '6'),
('4','17'),
('5', '3'),
('5', '4'),
('5', '2'),
('5', '1'),
('5', '8'),
('5', '9'),
('5', '10'),
('5','16'),
('5','15') ,
('6', '4'),
('6', '3'),
('6', '2'),
('6', '1'),
('6', '8'),
('6', '9'),
('6', '10'),
('6','14'),
('6','11'),
('7', '3'),
('7', '4'),
('7', '2'),
('7', '1'),
('7', '8'),
('7', '9'),
('7','13'),
('7','12'),
('7', '10');


INSERT INTO post (username,userId, postId, text, image, date) VALUES
('mahdipasyegane',1, 1, 'هرکی شعور رو جوری تعریف میکنه که طبق اون تعریف خودش با شعور حساب بشه', '1.jpeg', '2021-06-07'),
('mobinapooladi', 2,2, 'یکی از بزرگترین مشکلات و معضلات جامعه این است که افراد، تجربیات شخصی خود را به عنوان فکت علمی و قابل تعمیم به همه‌ی جامعه جا می‌زنند!', '', '2021-06-07'),
('amirroshandel',3, 3, 'زندگیت را خودت می نوازی
مهم نیست چند نفر مهمان موسیقی زندگیت می شوند.
فقط خودت تا آخر شنونده خودت خواهی ماند...مهم این است؛  پس خوب بنواز', '', '2021-06-07'),
('matinkoohjani',4, 4, 'مهم نیست مسلمونی یا مسیحی یا آتئیست
بعضی وقتها تنها راه اثبات یک قضیه
قسم خوردن به ابوالفضله
', '', '2021-06-07'),
('masudakhgar',5, 5, 'دلم واسه مامانم میسوزه وقتی آهنگای انگلیسی رکیکو حفظم و اون فکر میکنه زبانم عالیه :)))', '', '2021-06-07'),
('maryamhokmabadi',6, 6, 'باگ حافظه آدم اونجاس که هرجاشو دلت خواست نمیتونی پاک کنی یا تقویتش کنی
از اون بدتر وقتیه که اون خاطرات خوب زود پاک میشن و خاطرات بد پررنگتر', '', '2021-06-07'),
('omid',7, 7, 'بعضیا انقد خوشگل و جذابن که برنامم اینه تااخر عمرم ماسک رو صورتم باشه', '', '2021-06-07'),
('sarajalali',8,8,'عجیبه که عکس زن رو روی آگهی ترحیم نمی‌زنن ولی برای کاندیداتوری رو بیلبورد ۲متر در ۴متر میزنن','','2021-06-14'),
('sarajalali',8,9,'من در طول روز : بهتره شب زود بخوابم تا فردا سر حال بیدار شم
بازم من ساعت ۴ صبح : خب حالا میریم که میکس آهنگ پلنگ صورتی و باب اسفنجی رو با رقص اَبرو اجرا کنیم','','2021-06-14'),
('alitalebi',9,10,'خداروشکر من حتی به صورت شفاهی هم بهم نگفتن تا آخر باهات می‌مونم که بخوام شاکی باشم از کسی، شایدم خدارو نه شکر.','','2021-06-16'),
('mohammad',10,11,'تو بازیهای مهارتی چون بلد نیستم میبازم، تو بازیهای شانسی هم چون شانس ندارم
بازی سرنوشت هم که نگم براتون','','2021-06-12'),
('faridghari',11,12,'این رژهای ۲۴ساعته اصل هم با غذا خوردن پاک میشه، اما خدا نکنه فیکشو بخری :))) فقط اسکاج میتونه به دادت برسه :)))','','2021-06-12'),
('atefearab',12,13,'وقتی مامانت داره سریال تکراری نگاه میکنه برو ازش بپرس جریان این سریال چیه به احتمال ۹۰ درصد میگه نمیدونم','','2021-06-09'),
('nazanin_t',13,14,'من با هر نوع خشونت مخالفم؛ ولی اونی که وقتی ظرف میشوری هی ظرف اضافه میکنه رو باید با کفگیر سر برید.','','2021-06-17');


Insert Into  comment(username, userId, postId, comment) values ('amirroshandel',3, 1,'عاااالی');



INSERT INTO sadaf.SpecialPages VALUES (1,'main.php'),(2,'/main.php'),(3,'/Menu.php'),(4,'/MainContent.php'),(5,'/ChangePassword.php'),(6,'/MyActions.php'),(7,'/SelectPersonel.php'),(8,'/SelectCustomer.php'),(9,'/SelectStaff.php'),(10,'/GetExamItemPrice.php');


insert into sadaf.persons (pfname, plname, CardNumber) values ('اميد', 'ميلاني فرد', '0');

insert into sadaf.AccountSpecs (UserID, UserPassword, PersonID) values ('omid', '24e55aa5f1ef63746d8825d98c22df8d', 1); /* omid3000 md5 hashed*/

INSERT INTO sadaf.SystemFacilityGroups VALUES (1,'مدیریت',1),(2,'عملیات کاری',3),(3,'گزارشات',4);

INSERT INTO sadaf.SystemFacilities VALUES (1,'مدیریت افراد',1,3,'Managepersons.php'),(3,'مدیریت امکانات',1,2,'ManageSystemFacilities.php'),(4,'مدیریت گروه های منو',1,1,'ManageSystemFacilityGroups.php'),(5,'مدیریت کاربران',1,4,'ManageAccountSpecs.php'),(6,'وضعیت ثبت نام',1,5,'ManageSignUp.php');

INSERT INTO sadaf.UserFacilities VALUES (1,'omid',1),(2,'omid',3),(3,'omid',4),(4,'omid',5),(12,'omid',6);

INSERT INTO sadaf.EMonArray VALUES (1,31),(2,28),(3,31),(4,30),(5,31),(6,30),(7,31),(8,31),(9,30),(10,31),(11,30),(12,31);

INSERT INTO sadaf.FMonArray VALUES (1,31),(2,31),(3,31),(4,31),(5,31),(6,31),(7,30),(8,30),(9,30),(10,30),(11,30),(12,29);

INSERT INTO sadaf.FacilityPages VALUES (9,5,'/ManageAccountSpecs.php'),(3,3,'/ManageSystemFacilities.php'),(4,3,'/ManageFacilityPages.php'),(5,3,'/ManageSystemFacilities.php'),(6,3,'/ManageUserFacilities.php'),(7,4,'/ManageSystemFacilityGroups.php'),(8,1,'/Managepersons.php'),(48,12,'/GetJasonData.php'),(25,5,'/ManageUserPermissions.php'),(12,6,'/ManageSignUp.php');

INSERT INTO sadaf.ManageStatus VALUES (1,'SignUp',1);
DELIMITER $$

DROP FUNCTION IF EXISTS sadaf.`g2j`$$
CREATE FUNCTION  sadaf.g2j(_edate  date) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN
    declare gy,gm,gd    int ;
    declare  g_day_no   int ;
    declare  i  int;

    declare j_day_no ,  j_np ,  jy , jm , jd  int ;
    set gy  = year(_edate)-1600;
    set gm = month(_edate)-1;
    set gd  = day(_edate)-1;

    if  (year(_edate) < 1900  or year(_edate) > 2100  )  or (month(_edate) <1  or month(_edate)  > 12 )   or  (day(_edate) < 1 or day(_edate) > 31 )  then
        return 'date-error';
end if;

    set g_day_no = 365 * gy + floor((gy+3) /  4) - floor((gy+99) / 100) + floor((gy+399)/ 400);

    set i=0;
    while i < gm do
            set g_day_no=g_day_no+(select  emon from EMonArray  where _id=i+1);
            set i = i + 1;
end while;
    if  gm >1  and ((gy % 4 =0 and gy % 100 !=0)  or  (gy%400=0))   then
        set g_day_no = g_day_no + 1 ;
end if;
    set  g_day_no = g_day_no + gd;
    set  j_day_no =  g_day_no-79;
    set  j_np = floor(j_day_no /  12053);
    set  j_day_no = j_day_no % 12053;
    set  jy = 979+33 *  j_np + 4  *  floor(j_day_no /  1461);
    set j_day_no = j_day_no % 1461;

    if   j_day_no >= 366  then
        set jy = jy + floor((j_day_no-1) /  365);
        set j_day_no = (j_day_no-1) % 365;
end if;

    set  i=0;
    while  i < 11  and j_day_no >=  ( select fmon from FMonArray  where _id= i + 1)  do
            set j_day_no = j_day_no - ( select fmon from FMonArray  where _id = i + 1);
            set  i = i + 1;
end while;

    set jm = i+1;
    set jd = j_day_no+1;

return  concat_ws('/',jy,if(jm < 10 , concat('0',jm) , jm)    ,if(jd < 10 , concat('0',jd) , jd ));
END;

$$

DELIMITER ;

DELIMITER $$

DROP FUNCTION IF EXISTS sadaf.`j2g`$$
CREATE FUNCTION  sadaf.j2g(j_y int , j_m int , j_d  int ) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN

    declare  jy,jm,jd  int ;
    declare  j_day_no , g_day_no   , gy,gm,gd  int ;
    declare  i int ;
    declare  leap  bool;

    if  (j_y < 1300  or  j_y > 1450  )  or (j_m <1  or j_m  > 12 )   or  (j_d < 1 or j_d > 31 )  then
        return 'date-error';
end if;


    set  jy = j_y-979;
    set  jm = j_m-1;
    set  jd = j_d-1;

    set j_day_no = 365 * jy + floor(jy/33) * 8 + floor(((jy%33)+3) /  4);
    set i  = 0;
    while  i < jm  do
            set j_day_no = j_day_no + (select fmon from FMonArray  where  _id=i+1);
            set i = i+1;
end while;
    set  j_day_no = j_day_no + jd;
    set  g_day_no = j_day_no+79;
    set  gy = 1600 + 400 *  floor(g_day_no /  146097);
    set  g_day_no = g_day_no % 146097;
    set  leap = true;
    if  g_day_no >= 36525  then
        set g_day_no = g_day_no - 1;
        set gy = gy + 100 * floor(g_day_no /  36524);
        set g_day_no = g_day_no % 36524;
        if  g_day_no >= 365  then
            set g_day_no  =  g_day_no + 1;
else
            set leap = false;
end if;
end if;
    set gy = gy + 4 *  floor(g_day_no / 1461);
    set g_day_no = g_day_no % 1461;
    if  g_day_no >= 366  then
        set leap = false;
        set g_day_no = g_day_no - 1 ;
        set gy = gy + floor(g_day_no /  365);
        set g_day_no = g_day_no % 365;
end if;
    set  i = 0;
    while  g_day_no >= ( select  emon from EMonArray  where _id = i + 1 ) + ( select if(i = 1 and  leap = true , 1 , 0) )   do
            set g_day_no = g_day_no - (( select  emon from EMonArray  where _id = i + 1)  + ( select if ( i = 1 and  leap= true ,1,0)));
            set i = i + 1;
end while;
    set gm = i+1;
    set gd = g_day_no+1;
return  concat_ws('-',gy , gm , gd );
END;

$$

DELIMITER ;
