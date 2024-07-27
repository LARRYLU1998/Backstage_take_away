DELIMITER $$

-- bulletin_id
CREATE TRIGGER before_insert_bulletin_id
BEFORE INSERT ON bulletin
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(bulletin_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM bulletin ;
    SET NEW.bulletin_id = CONCAT('BI', LPAD(next_id, 5, '0'));
END$$

-- commodity_id
CREATE TRIGGER before_insert_commodity_id
BEFORE INSERT ON commodity
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(commodity_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM commodity;
    SET NEW.commodity_id = CONCAT('CI', LPAD(next_id, 5, '0'));
END$$

-- order_id
CREATE TRIGGER before_insert_order_id
BEFORE INSERT ON order_history
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(order_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM order_history;
    SET NEW.order_id = CONCAT('OI', LPAD(next_id, 5, '0'));
END$$

-- order_detail_id
CREATE TRIGGER before_insert_order_detail
BEFORE INSERT ON order_detail
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(order_detail, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM order_detail;
    SET NEW.order_detail = CONCAT('OD', LPAD(next_id, 5, '0'));
END$$

-- user_id
CREATE TRIGGER before_insert_user_id
BEFORE INSERT ON user
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(pet_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM user;
    SET NEW.user_id = CONCAT('UI', LPAD(next_id, 5, '0'));
END$$

-- pet_-id
-- 新增一個觸發器 before_insert_pet_id
CREATE TRIGGER before_insert_pet_id
-- 在新增資料前觸發
BEFORE INSERT ON pet_info
-- 針對每行執行一次
FOR EACH ROW
BEGIN
	-- 宣告變數
    DECLARE next_id INT;
	-- SUBSTRING函數來截取pet_id中的數字部分，然后将其轉换为無符號整数（UNSIGNED）進行比较。如果表中没有任何紀錄，則使用IFNULL函数確保默認next_id為0。
    SELECT IFNULL(MAX(CAST(SUBSTRING(pet_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM pet_info;
	-- 將產生的新的數字與"PI"前綴連接起來，然後將其設定為新插入行的pet_id。 LPAD函數是將數字部分補足至五位，不足的部分用0補。
    SET NEW.pet_id = CONCAT('PI', LPAD(next_id, 5, '0'));
END$$

-- action_id
CREATE TRIGGER before_insert_action_id
BEFORE INSERT ON pet_action
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(action_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM pet_action;
    SET NEW.action_id = CONCAT('AI', LPAD(next_id, 5, '0'));
END$$

-- blog_id
CREATE TRIGGER before_insert_blog_id
BEFORE INSERT ON blog
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(blog_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM blog;
    SET NEW.blog_id = CONCAT('PB', LPAD(next_id, 5, '0'));
END$$

-- mypet_id
CREATE TRIGGER before_insert_mypet_id
BEFORE INSERT ON mypet
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(mypet_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM mypet;
    SET NEW.mypet_id = CONCAT('MI', LPAD(next_id, 5, '0'));
END$$

-- adopt_id
CREATE TRIGGER before_insert_adopt_id
BEFORE INSERT ON online_virtual_adoption_form
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(adopt_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM online_virtual_adoption_form;
    SET NEW.adopt_id = CONCAT('AD', LPAD(next_id, 5, '0'));
END$$

-- reservation_id
CREATE TRIGGER before_insert_reservation_id
BEFORE INSERT ON reserve_system
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(reservation_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM reserve_system;
    SET NEW.reservation_id = CONCAT('RI', LPAD(next_id, 5, '0'));
END$$

-- favorite_id
CREATE TRIGGER before_insert_favorite_id
BEFORE INSERT ON favorite
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(favorite_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM favorite;
    SET NEW.favorite_id = CONCAT('FI', LPAD(next_id, 5, '0'));
END$$

-- question_id
CREATE TRIGGER before_insert_faq_question_id
BEFORE INSERT ON faq_shopinfo
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(question_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM faq_shopinfo;
    SET NEW.question_id = CONCAT('QI', LPAD(next_id, 5, '0'));
END$$

-- question_adopt_id
CREATE TRIGGER before_insert_question_adopt_id
BEFORE INSERT ON notice_adoptinfo
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(question_adopt_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM notice_adoptinfo;
    SET NEW.question_adopt_id = CONCAT('QA', LPAD(next_id, 5, '0'));
END$$

-- question_id
CREATE TRIGGER before_insert_psycological_question_id
BEFORE INSERT ON psycological_test
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    SELECT IFNULL(MAX(CAST(SUBSTRING(question_id, 3) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM psycological_test;
    SET NEW.question_id = CONCAT('PQ', LPAD(next_id, 5, '0'));
END$$

DELIMITER ;