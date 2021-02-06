drop table if exists scriptures;
create table scriptures (id serial not null primary key
, book varchar(30) not null
, chapter int not null
, verse int not null
, content TEXT not null
);

insert into scriptures (book, chapter, verse, content) VALUES
('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.');

insert into scriptures (book, chapter, verse, content) VALUES
('D&C', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.');

insert into scriptures (book, chapter, verse, content) VALUES
('D&C', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.');

insert into scriptures (book, chapter, verse, content) VALUES
('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');
