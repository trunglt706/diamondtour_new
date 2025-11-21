UPDATE user_menus
SET link = REPLACE(link, 'https://diamondtour.vn', 'http://127.0.0.1:8000')
WHERE link LIKE 'https://diamondtour.vn%';