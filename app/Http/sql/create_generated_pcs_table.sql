CREATE TABLE computers
(
	id                serial PRIMARY KEY,
	cpu               integer NOT NULL REFERENCES hardwares (id),
	gpu               integer NOT NULL REFERENCES hardwares (id),
	ram               integer NOT NULL REFERENCES hardwares (id),
	gamer_score       numeric NOT NULL,
	workstation_score numeric NOT NULL,
	desktop_score     numeric NOT NULL

);

CREATE TABLE storage
(
	id         serial PRIMARY KEY,
	pc_id      integer NOT NULL REFERENCES computers (id),
	storage_id integer NOT NULL REFERENCES hardwares (id)
);

