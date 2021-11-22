#-- get categories with posts
SELECT DISTINCT c.*
FROM category AS c
    INNER JOIN category_post
        USING (category_id);
#-- get authors with posts
SELECT DISTINCT a.*
FROM author AS a
    INNER JOIN post
        USING (author_id);
#-- get Category by ID
SELECT *
FROM category
WHERE category_id = 3;
#-- get Post by ID
SELECT *
FROM post
WHERE post_id = 15;
#-- get Author by ID
SELECT *
FROM author
WHERE author_id = 7;
#-- get Category by URL
SELECT *
FROM category
WHERE url = 'sport';
#-- get Post by URL
SELECT *
FROM post
WHERE url = 'post_110';
#-- get Author by URL
SELECT *
FROM author
WHERE url = 'surname-11';
#-- get Posts by Category
SELECT p.*
FROM post AS p
    INNER JOIN category_post
        USING (post_id)
WHERE category_id = 9;
#-- authors sorted by number of posts (highest to lowest)
SELECT a.*, COUNT(post_id) AS posts_counter
FROM author AS a
    LEFT JOIN post
        USING (author_id)
GROUP BY author_id
ORDER BY posts_counter DESC;
#-- categories with the highest number of authors
SELECT c.*, COUNT(DISTINCT author_id) AS authors_counter
FROM category AS c
    INNER JOIN category_post
        USING (category_id)
    INNER JOIN post
        USING (post_id)
GROUP BY category_id
ORDER BY authors_counter DESC;
#-- get authors without namesakes (using subquery with grouping)
SELECT a.*
FROM author AS a
WHERE a.surname NOT IN(
    SELECT surname
    FROM author AS a1
    GROUP BY surname
    HAVING COUNT(surname) > 1
);
#-- get authors without namesakes (using left join to the same table)
SELECT  a.*
FROM author AS a
    LEFT JOIN author AS a1
        ON a.surname = a1.surname
        AND a.author_id != a1.author_id
GROUP BY a.author_id
HAVING COUNT(a1.surname) < 1;