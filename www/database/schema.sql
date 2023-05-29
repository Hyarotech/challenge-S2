CREATE TABLE "user" (
    "id" SERIAL PRIMARY KEY,
    "firstname" VARCHAR(50) NOT NULL,
    "lastname" VARCHAR(50) NOT NULL,
    "country" VARCHAR(50) NOT NULL,
    "email" VARCHAR(100) NOT NULL,
    "password" VARCHAR(100) NOT NULL,
    "status" INTEGER DEFAULT 0,
    "date_inserted" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "date_updated" TIMESTAMP
);
