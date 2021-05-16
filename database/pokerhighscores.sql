use joki20;

--
-- Pokerhighscores table
-- 
DROP TABLE IF EXISTS pokerhighscores;
CREATE TABLE IF NOT EXISTS pokerhighscores
(
    id integer not null auto_increment primary key, 
    player char(30) not null,
    score integer default 0,
    count_nothing integer default 0,
    count_pair integer default 0,
    count_twopairs integer default 0,
    count_threeofakind integer default 0,
    count_straight integer default 0,
    count_flush integer default 0,
    count_fullhouse integer default 0,
    count_fourofakind integer default 0,
    count_straightflush integer default 0,
    count_royalstraightflush integer default 0
);
-- empty table
-- DELETE FROM pokerhighscores;

select * from pokerhighscores;

