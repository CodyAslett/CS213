-- psql -U username -d myDataBase -a -f myInsertFile
-- psql -h host -U username -d myDataBase -a -f myInsertFile

-- psql -d cookbook -a -f DB.sql


-- setup and seed database
CREATE DATABASE cookbook;
\c cookbook

CREATE USER php_user WITH PASSWORD 'unlockForPHP6006';
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO note_user;
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO note_user;



-- 0
DROP TABLE favorites;
DROP TABLE ratings;
DROP TABLE pictures;
DROP TABLE instructions;
DROP TABLE ingredients_users;
DROP TABLE ingredients_recipes;
DROP TABLE recipe_tags; 
-- 1
DROP TABLE tags;
-- 2
DROP TABLE qt_type; -- ingredients_recipes, ingredients_users
DROP TABLE ingredients; -- ingredients_recipes, ingredients_users
-- 1
DROP TABLE food_groups;
-- 7
DROP TABLE recipes; -- recipe_tags, ingredients_recipes, ingredients_users, instructions, pictures, ratings, favorites
-- 4
DROP TABLE users; -- recipes, pictures, ratings, favorites



-- 4 Dependencies
CREATE TABLE public.users
(
	id SERIAL NOT NULL PRIMARY KEY,
	username VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	display_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL
);

-- 7 Dependencies
CREATE TABLE public.recipes
(
  id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  creator_users_id INT NOT NULL REFERENCES public.users(id)
);

-- 2 Dependencies
CREATE TABLE public.qt_type
(
    id SERIAL NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE public.food_groups
(
    id SERIAL NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE public.ingredients
(
    id SERIAL NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    group_id INT NOT NULL REFERENCES public.food_groups(id)
);

-- 1 Dependencie
CREATE TABLE public.tags
(
    id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL
);

-- No Dependencies 
CREATE TABLE public.recipe_tags
(
    id SERIAL NOT NULL PRIMARY KEY,
	recipe_id INT NOT NULL REFERENCES public.recipes(id),
    tag_id INT NOT NULL REFERENCES public.tags(id)
);

CREATE TABLE public.ingredients_recipes
(
    id SERIAL NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL REFERENCES public.recipes(id),
    ingredient_id INT NOT NULL REFERENCES public.ingredients(id),
    qt NUMERIC(5, 3) NOT NULL,
    qt_type INT NOT NULL REFERENCES public.qt_type(id)
);

CREATE TABLE public.ingredients_users -- for pantry if want to implement "what can i make"
(
    id SERIAL NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL REFERENCES public.recipes(id),
    ingredient_id INT NOT NULL REFERENCES public.ingredients(id),
    qt NUMERIC(5, 3) NOT NULL,
    qt_type INT NOT NULL REFERENCES public.qt_type(id)
);

-- might want to include what ingredents are relivent
CREATE TABLE public.instructions
(
	id SERIAL NOT NULL PRIMARY KEY,
	instruction_text TEXT NOT NULL,
    recipes_id INT NOT NULL REFERENCES public.recipes(id),
    num_order INT NOT NULL
);

CREATE TABLE public.pictures
(
    id SERIAL NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL REFERENCES public.recipes(id),
    users_id INT NOT NULL REFERENCES public.users(id)
);

CREATE TABLE public.ratings
(
    id SERIAL NOT NULL PRIMARY KEY,
	score int NOT NULL,
    recipe_id INT NOT NULL REFERENCES public.recipes(id),
    users_id INT NOT NULL REFERENCES public.users(id)
);

CREATE TABLE public.favorites
(
    id SERIAL NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL REFERENCES public.recipes(id),
    users_id INT NOT NULL REFERENCES public.users(id)
);



-- prime the data base some infomation


-- USERS
INSERT INTO users (username, password, display_name, email) -- 1
  VALUES ('testUserName', '1234', 'TestDisplayName', 'testemail@testing.com');

INSERT INTO users (username, password, display_name, email) -- 2
  VALUES ('shay', 'book', 'sis', 'shayln@gmail.com');

INSERT INTO users (username, password, display_name, email) -- 3
  VALUES ('kaden', 'smoke', 'magic Dragon', 'kadenisthebest69@gamil.com');

INSERT INTO users (username, password, display_name, email) -- 4
  VALUES ('angie', 'childsBirthday', 'mom', 'cmcangie@hotmail.com');

INSERT INTO users (username, password, display_name, email) -- 5
  VALUES ('kelli', 'music', 'Queen Leia', 'starwarsgirl@gmail.com');

INSERT INTO users (username, password, display_name, email) -- 6
  VALUES ('cody', 'masterPass', 'ADMIN', 'wel12011@byui.edu');


-- FOOD GROUPS
 --https://health.gov/dietaryguidelines/2015/guidelines/chapter-1/a-closer-look-inside-healthy-eating-patterns/
INSERT INTO food_groups (name) --1
  VALUES ('test_group');

INSERT INTO food_groups (name) -- 2
  VALUES ('vegetable');

INSERT INTO food_groups (name) -- 3
  VALUES ('fruit');

INSERT INTO food_groups (name) -- 4 
  VALUES ('grain');

INSERT INTO food_groups (name) -- 5
  VALUES ('dairy');

INSERT INTO food_groups (name) -- 6
  VALUES ('protein');

INSERT INTO food_groups (name) -- 7
  VALUES ('oil');

INSERT INTO food_groups (name) -- 8
  VALUES ('sweetener');

INSERT INTO food_groups (name) -- 9
  VALUES ('spice'); 

INSERT INTO food_groups (name) -- 10
  VALUES ('baking');

INSERT INTO food_groups (name) -- 11
  VALUES ('other');


--QT types
--   - should include name if plural, and abbreviation
INSERT INTO qt_type(name) --1
    VALUES('cup');

INSERT INTO qt_type(name) --2
    VALUES('tablespoon');

INSERT INTO qt_type(name) --3
    VALUES('teaspoon');

INSERT INTO qt_type(name) -- 4
    VALUES('quart');

INSERT INTO qt_type(name) -- 5
    VALUES('gallon');

INSERT INTO qt_type(name) -- 6
    VALUES('pint');

INSERT INTO qt_type(name) -- 7
    VALUES('pint');

INSERT INTO qt_type(name) --8
    VALUES('dash');

INSERT INTO qt_type(name) -- 9
    VALUES('pinch');

INSERT INTO qt_type(name) -- 10
    VALUES('grams');

INSERT INTO qt_type(name) -- 11
    VALUES('ounce');

INSERT INTO qt_type(name) -- 12
    VALUES('quantity');


-- INGREDIENTS
INSERT INTO ingredients (name, group_id) -- 1
   VALUES('test ingredient 1', 1);

INSERT INTO ingredients (name, group_id) -- 2
   VALUES('test ingredient 2', 1);

INSERT INTO ingredients (name, group_id) -- 3
   VALUES('test ingredient 3', 1);   

INSERT INTO ingredients (name, group_id) --4 
   VALUES('milk', 5);

INSERT INTO ingredients (name, group_id) -- 5
   VALUES('egg', 5);    

INSERT INTO ingredients (name, group_id) -- 6
   VALUES('tortilla', 4);

INSERT INTO ingredients (name, group_id) -- 7
   VALUES('water', 11);

INSERT INTO ingredients (name, group_id) -- 8 
   VALUES('canola oil', 7);

INSERT INTO ingredients (name, group_id) -- 9
   VALUES('flour', 4);

INSERT INTO ingredients (name, group_id) -- 10
   VALUES('chicken broth', 11);

INSERT INTO ingredients (name, group_id) -- 11
   VALUES('salt', 9);

INSERT INTO ingredients (name, group_id) -- 12
   VALUES('black pepper', 9);

INSERT INTO ingredients (name, group_id) -- 13
   VALUES('ground beef', 6);

INSERT INTO ingredients (name, group_id) --14
   VALUES('chopped onion', 2);

INSERT INTO ingredients (name, group_id) -- 15
   VALUES('diced green chilies', 2);

INSERT INTO ingredients (name, group_id) -- 16
   VALUES('chopped green onions', 2);

INSERT INTO ingredients (name, group_id) -- 17
   VALUES('chopped black olives', 2);

INSERT INTO ingredients (name, group_id) -- 18
   VALUES('grated cheddar cheese', 5);
 
INSERT INTO ingredients (name, group_id) -- 19
   VALUES('baking powder', 10);

INSERT INTO ingredients (name, group_id) -- 20
   VALUES('sugar', 8);

INSERT INTO ingredients (name, group_id) -- 21
   VALUES('butter', 5);


-- TAGS
INSERT INTO tags (name) --1
    VALUES('Test Tag');

INSERT INTO tags (name) --2
   VALUES('dairy');

INSERT INTO tags (name) --3
   VALUES('gluten free');

INSERT INTO tags (name) --4
   VALUES('vegetable');

INSERT INTO tags (name) --5
   VALUES('beef');

INSERT INTO tags (name) --6
   VALUES('chiken');

INSERT INTO tags (name) --7
   VALUES('fish');

INSERT INTO tags (name) --8
   VALUES('meat');

INSERT INTO tags (name) --9
   VALUES('protein');

INSERT INTO tags (name) --10
   VALUES('fruit');

INSERT INTO tags (name) -- 11
   VALUES('grain');

INSERT INTO tags (name) --12
   VALUES('oil');

INSERT INTO tags (name) --13
   VALUES('sodium');

INSERT INTO tags (name) --14
   VALUES('saturated fats');

INSERT INTO tags (name) --15
   VALUES('add sugar');

INSERT INTO tags (name) --16
   VALUES('dessert');

INSERT INTO tags (name) --17
   VALUES('breakfast');

INSERT INTO tags (name) --18
   VALUES('brunch');

INSERT INTO tags (name) --19
   VALUES('main dish');

INSERT INTO tags (name) --20
   VALUES('vegetarian');

INSERT INTO tags (name) --21
   VALUES('quick & easy');



---------------------------------------------------------------------
-- RECIPES
-- 
---------------------------------------------------------------------
-- INSERT INTO recipes(name, description, creator_users_id) -- 1
--    VALUES('Test Recipe', 'testing recipes description. testing recipes description, testing recipes description ',1);

-- INSERT INTO recipes (name, description, creator_users_id) -- 2
--   VALUES ('testFood', 'somethign vary yummy', 1);

INSERT INTO recipes(name, description, creator_users_id) -- 1
   VALUES('Meatball Ramen', 'a quick and easy meal',2);

INSERT INTO recipes(name, description, creator_users_id) -- 2
   VALUES('Pancakes', 'A old fashioned classic, that everyone loves',4);


-- INGREDIENTS in RECIPES
-- INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
--     VALUES(1, 1, 1, 1);

-- INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
--     VALUES(1, 2, 10, 2);

-- INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
--     VALUES(1, 3, .5, 3);

-- INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
--     VALUES(2, 1, .0625, 3);

-- INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
--     VALUES(2, 2, 1.5, 2);

-- INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
--     VALUES(2, 3, .5, 1);

INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
    VALUES(2, 9, 1.5, 1);

INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
    VALUES(2, 19, 3.5, 3);

INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
    VALUES(2, 11, 1, 3);

INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
    VALUES(2, 20, 1, 2);

INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
    VALUES(2, 4, 1.25, 1);

INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
    VALUES(2, 5, 1, 12);

INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type)
    VALUES(2, 21, 3, 2);



-- INSTRUCTIONS - to make recipies
-- INSERT INTO instructions(instruction_text, recipes_id, num_order) -- Test Recipe
--     VALUES('test instruction 1', 1, 1);

-- INSERT INTO instructions(instruction_text, recipes_id, num_order) -- Test Recipe
--     VALUES('test instruction 2', 1, 2);

-- INSERT INTO instructions(instruction_text, recipes_id, num_order) -- Test Recipe
--     VALUES('test instruction 3', 1, 3);

INSERT INTO instructions(instruction_text, recipes_id, num_order) -- Pancakes
    VALUES('In a large bowl, sift together the flour, baking powder, salt and sugar. Make a well in the center and pour in the milk, egg and melted butter; mix until smooth.', 2, 1);

INSERT INTO instructions(instruction_text, recipes_id, num_order) -- Pancakes
    VALUES('Heat a lightly oiled griddle or frying pan over medium high heat. Pour or scoop the batter onto the griddle, using approximately 1/4 cup for each pancake. Brown on both sides and serve hot.', 2, 2);



-- PICTURES
-- INSERT INTO pictures(recipe_id, users_id) --Test Recipe
--     VALUES(1, 1);

-- INSERT INTO pictures(recipe_id, users_id) --testFood
--     VALUES(2, 1);

INSERT INTO pictures(recipe_id, users_id) --Meatball Ramen
    VALUES(1, 2);

INSERT INTO pictures(recipe_id, users_id) --Pancakes
    VALUES(2, 4);


-- RECIPES TAGS
INSERT INTO recipe_tags(recipe_id, tag_id) --1
   VALUES(1, 1);

INSERT INTO recipe_tags(recipe_id, tag_id) --2
   VALUES(2, 5);

INSERT INTO recipe_tags(recipe_id, tag_id) --3
   VALUES(2, 6);

INSERT INTO recipe_tags(recipe_id, tag_id) --4
   VALUES(2, 9);

INSERT INTO recipe_tags(recipe_id, tag_id) --5
   VALUES(2, 10);

INSERT INTO recipe_tags(recipe_id, tag_id) --6 
   VALUES(2, 11);

INSERT INTO recipe_tags(recipe_id, tag_id) -- 8
   VALUES(2, 11);




-- show what we got
SELECT * FROM users;
SELECT * FROM food_groups;
SELECT * FROM recipes;
SELECT * FROM ingredients;
SELECT * FROM instructions;
SELECT * FROM tags;
SELECT * FROM recipes;
SELECT * FROM recipe_tags;

SELECT column_default FROM information_schema.columns where table_name='recipes';