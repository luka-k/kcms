CREATE TABLE [CARDS] (
	[card_number] TEXT NOT NULL,
	[card_day_limit] DECIMAL NOT NULL, 
	[card_credit_limit] DECIMAL NOT NULL,
	[card_balance] DECIMAL NOT NULL,
	CONSTRAINT [] PRIMARY KEY ([card_number]));
	
CREATE TABLE [CATEGORIES] (
	[id] INT NOT NULL,
	[name] TEXT NOT NULL,
	[sort] INT NOT NULL DEFAULT 0,
	CONSTRAINT [] PRIMARY KEY ([id]));
	
CREATE TABLE [CHILD2PRODUCT] (
	[child_user_id] INT NOT NULL REFERENCES [CHILD_USERS]([id]),
	[product_id] INT NOT NULL REFERENCES [PRODUCTS]([id]),
	[disabled] BOOL NOT NULL DEFAULT true,
	CONSTRAINT [sqlite_autoindex_CHILD2PRODUCT_1] PRIMARY KEY ([child_user_id], [product_id]));
	
CREATE TABLE [CHILD_USERS] (
	[id] INT NOT NULL,
	[class] TEXT,
	[card_number] TEXT NOT NULL REFERENCES [CARDS]([card_number]),
	[first_name] TEXT,
	[last_name] TEXT,
	[middle_name] TEXT,
	[birthday] DATE,
	[phone] TEXT,
	[image] BLOB,
	CONSTRAINT [] PRIMARY KEY ([id]));
	
CREATE TABLE [ORDER2PRODUCTS] (
	[order_id] INT NOT NULL REFERENCES [ORDERS]([id]),
	[product_id] INT NOT NULL REFERENCES [PRODUCTS]([id]),
	[quantity] INT NOT NULL,
	CONSTRAINT [sqlite_autoindex_ORDER2PRODUCTS_1] PRIMARY KEY ([order_id], [product_id]));
	
CREATE TABLE [ORDERS] (
	[id] INT NOT NULL,
	[card_number] TEXT NOT NULL,
	[date] DATETIME NOT NULL,
	[summ] DECIMAL NOT NULL,
	[operation] TEXT NOT NULL,[info] TEXT,
	CONSTRAINT [sqlite_autoindex_ORDERS_1] PRIMARY KEY ([id]));
	
CREATE TABLE [PRODUCTS] (
	[id] INT NOT NULL ON CONFLICT FAIL,
	[name] TEXT NOT NULL,
	[weight] TEXT NOT NULL,
	[price] DECIMAL NOT NULL,
	[category_id] INT NOT NULL REFERENCES [CATEGORIES]([id]),
	[sort] INT NOT NULL DEFAULT 0,
	CONSTRAINT [sqlite_autoindex_PRODUCTS_1] PRIMARY KEY ([id]));
	
	