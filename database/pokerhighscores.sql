use joki20;

--
-- Pokerhighscores table
-- 
DROP TABLE IF EXISTS pokerhighscores;
CREATE TABLE IF NOT EXISTS pokerhighscores
(
    id integer not null auto_increment primary key, 
    player char(30) not null,
    finalscore char(40) not null,
    count_nothing integer not null,
    count_pair integer not null,
    count_twopair integer not null,
    count_threeofakind integer not null,
    count_straight integer not null,
    count_flush integer not null,
    count_fullhouse integer not null,
    count_fourofakind integer not null,
    count_straightflush integer not null,
    count_royalflush integer not null
);
-- empty table
-- DELETE FROM pokerhighscores;

select * from pokerhighscores;

