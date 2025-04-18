CREATE TABLE `Vehicles` (
	`VehicleID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`MakeID` INTEGER COMMENT 'Mã hãng xe', 
	`ModelID` INTEGER COMMENT ' Mã mẫu xe',
	`Seats` INTEGER COMMENT 'Số chỗ ngồi',
	`VehicleTypesID` INTEGER COMMENT 'Loại xe (Hạng sang, tầm trung, phổ thông)',
	`HourlyPrice` DOUBLE COMMENT 'Giá thuê theo giờ mặc định',
	`DailyPrice` DOUBLE COMMENT 'Giá thuê theo ngày mặc định',
	`WeeklyPrice` DOUBLE COMMENT 'Giá thuê theo tuần mặc định',
	`MonthlyPrice` DOUBLE COMMENT 'Giá thuê theo tháng mặc định',
	`Quantity` INTEGER COMMENT 'Tổng số lượng xe hãng và mẫu',
	`Description` VARCHAR(500) COMMENT 'Mô tả',	
	`Is_Feature` INTEGER COMMENT 'Xe nổi bật',
	`PromotionID` INTEGER COMMENT 'Mã khuyến mãi',
	`Active` INTEGER DEFAULT 1 COMMENT 'Trạng thái xe (0: Ngừng hoạt đông, 1: Đang hoạt động)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`VehicleID`)
) COMMENT 'Thông tin xe cần cho thuê chung';

CREATE TABLE `VehicleDetails` (
	`VehicleDetailID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`VehicleID` INTEGER,
	`ColorID` INTEGER COMMENT 'Màu xe',
	`LicensePlateNumber` VARCHAR(255) COMMENT 'Biển số xe',
	`Mileage` FLOAT COMMENT 'Số km đã đi',
	`Year` INTEGER COMMENT 'Năm sản xuất',
	`Transmission` VARCHAR(255) COMMENT 'Hộp số',
	`FuelType` VARCHAR(255) COMMENT 'Loại nhiên liệu',
	`HourlyPrice` DOUBLE NULL COMMENT 'Giá thuê theo giờ (override, nếu khác Vehicles)',
	`DailyPrice` DOUBLE NULL COMMENT 'Giá thuê theo ngày (override)',
	`WeeklyPrice` DOUBLE NULL COMMENT 'Giá thuê theo tuần (override)',
	`MonthlyPrice` DOUBLE NULL COMMENT 'Giá thuê theo tháng (override)',
	`FuelConsumption` VARCHAR(255) COMMENT 'Mức tiêu hao nhiên liệu (L/100km)',
	`Active` INTEGER DEFAULT 1 COMMENT 'Trạng thái xe (0: Ngừng hoạt động, 1: Đang hoạt động)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`VehicleDetailID`)
) COMMENT 'Thông tin chi tiết xe';

CREATE TABLE `VehicleImages` (
	`ImageID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`VehicleDetailID` INTEGER COMMENT 'Mã chi tiết xe liên kết Vehicles',
	'VehicleID' INTEGER COMMENT 'Mã xe liên kết Vehicles',
	`ImageURL` VARCHAR(255) COMMENT 'Đường dẫn ảnh',
	`IsPrimary` INTEGER COMMENT 'Ảnh chính',
	PRIMARY KEY(`ImageID`)
) COMMENT 'Hình ảnh xe';

CREATE TABLE `VehicleTypes` (
	`VehicleTypesID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`NameType` VARCHAR(255) COMMENT 'Tên loại xe (Hạng sang, tầm trung, phổ thông)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`VehicleTypesID`)
) COMMENT 'Loại xe (Hạng sang, tầm trung, phổ thông)';

CREATE TABLE `Colors` (
	`ColorID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`ColorName` VARCHAR(255) COMMENT 'Tên màu',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`ColorID`)
) COMMENT 'Màu xe';

CREATE TABLE `Makes` (
	`MakeID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`MakeName` VARCHAR(255) COMMENT 'Tên hãng xe',
	`Country` VARCHAR(255) COMMENT 'Quốc gia',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`MakeID`)
) COMMENT 'Hãng xe (Toyota, Honda, Ford, ...)';

CREATE TABLE `Models` (
	`ModelID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,       
	`ModelName` VARCHAR(255) COMMENT 'Tên mẫu xe',           
	`MakeID` INTEGER COMMENT 'Mã hãng xe',                                        
	`VehicleTypesID` INTEGER COMMENT 'Loại xe (Hạng sang, tầm trung, phổ thông)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`ModelID`),
	FOREIGN KEY(`MakeID`) REFERENCES `Makes`(`MakeID`)
) COMMENT 'Mẫu xe (Camry, Civic, Fortuner, ...)';

CREATE TABLE `RentalOrders` (
	`OrderID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`CustomerID` INTEGER COMMENT 'Mã khách hàng',
	`UserID` INTEGER COMMENT 'Mã nhân viên xác nhận đơn hàng',
	`OrderDate` DATETIME COMMENT 'Ngày đặt xe',
	`RentalDate` DATETIME COMMENT 'Ngày thuê xe',
	`TotalAmount` DOUBLE COMMENT 'Tổng số tiền',
	`Address` VARCHAR(255) COMMENT 'Địa chỉ nhận xe',
	`PromotionID` INTEGER COMMENT 'Mã khuyến mãi',
	`Status` INTEGER DEFAULT 1 COMMENT 'Trạng thái đơn hàng (0: Chưa trả xe, 1: Đã trả xe)',
	`PaymentID` INTEGER,
	PRIMARY KEY(`OrderID`)
) COMMENT 'Đơn hàng thuê xe';

CREATE TABLE `RentalOrderDetails` (
	`OrderDetailID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`OrderID` INTEGER,
	`VehicleDetailID` INTEGER,
	`RentalRate` DOUBLE COMMENT 'Giá thuê',
	`RentalType` DOUBLE COMMENT 'Thuê theo giờ, ngày, tuần, tháng (1: Giờ, 2: Ngày, 3: Tuần, 4: Tháng)',
	`ReturnDate` DATETIME COMMENT 'Ngày trả xe',
	`ActualReturnDate` DATETIME COMMENT 'Ngày trả xe thực tế',
	`DamagePenalty` DOUBLE COMMENT 'Phạt hỏng hóc',
	`UserID` INTEGER COMMENT 'Nhân viên nhận xe',
	`Notes` VARCHAR(255) COMMENT 'Ghi chú',
	`Active` INTEGER DEFAULT 0 COMMENT 'Khách hàng đã gia hạn thuê thêm vài ngày nữa chưa? 
0 - Chưa gia hạn (Hiện thị nút Gia hạn)
1 - Đã gia hạn rồi (Ẩn nút Gia Hạn)',
	`Status` INTEGER DEFAULT 0 COMMENT 'trạng thái trả xe chưa? (0: Chưa trả xe, 1: Đã trả xe)',
	PRIMARY KEY(`OrderDetailID`)
) COMMENT 'Chi tiết đơn hàng thuê xe';

CREATE TABLE `Deposits` (
    `DepositID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
    `OrderID` INTEGER COMMENT 'Mã đơn hàng liên kết với đặt cọc',
    `DepositType` INTEGER COMMENT 'Loại đặt cọc (Tiền mặt, Thế chấp xe) (0: Tiền mặt, 1: Thế chấp xe)',
    `DepositValue` DOUBLE COMMENT 'Giá trị đặt cọc (số tiền hoặc giá trị xe)',
    `VehicleInfo` VARCHAR(255) COMMENT 'Thông tin xe thế chấp (nếu có)' DEFAULT NULL,
    `DepositDate` DATETIME COMMENT 'Ngày đặt cọc',
	`ReturnDate` DATETIME COMMENT 'Ngày hoàn trả cọc',
	`Active` INTEGER DEFAULT 0 COMMENT 'Trạng thái đặt cọc (0: Chưa nhận cọc, 1: Đã nhận cọc)',
    `Status` INTEGER DEFAULT 0 COMMENT 'Trạng thái trả cọc (0: Chưa trả cọc, 1: Đã hoàn trả)',
    PRIMARY KEY (`DepositID`),
    FOREIGN KEY (`OrderID`) REFERENCES `RentalOrders`(`OrderID`)
) COMMENT 'Thông tin đặt cọc';

CREATE TABLE `Payments` (
	`PaymentID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`OrderID` INTEGER COMMENT 'Mã đơn hàng liên kết với thanh toán',
	`PaymentDate` DATETIME COMMENT 'Ngày thanh toán',
	`PaymentMethod` INTEGER COMMENT 'Phương thức thanh toán (Tiền mặt, chuyển khoản) (0: Tiền mặt, 1: Chuyển khoản)',
	`Amount` DOUBLE COMMENT 'Số tiền',
	`Status` INTEGER DEFAULT 0 COMMENT 'Trạng thái thanh toán (0: Chưa thanh toán, 1: Đã thanh toán)',
	PRIMARY KEY(`PaymentID`)
) COMMENT 'Thông tin thanh toán';


CREATE TABLE `Users` (
	`UserID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE COMMENT 'Mã người dùng',
	`FullName` VARCHAR(255) COMMENT 'Họ tên',
	`PhoneNumber` VARCHAR(255),
	`Sex` INTEGER COMMENT 'Giới tính (0: Nam, 1: Nữ)',
	`IdentityCard` VARCHAR(255),
	`DateOfBirth` DATE COMMENT 'Ngày sinh',
	`AccountID` INTEGER,
	`Active` INTEGER DEFAULT 1 COMMENT 'Trạng thái tài khoản (0: Chưa kích hoạt, 1: Đã kích hoạt)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`UserID`)
) COMMENT 'Thông tin người dùng';

CREATE TABLE `Customers` (
	`CustomerID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE COMMENT 'Mã khách hàng (CCCD)',
	`FullName` VARCHAR(255) COMMENT 'Họ tên',
	`PhoneNumber` VARCHAR(255) COMMENT 'Số điện thoại',
	`DateOfBirth` DATE COMMENT 'Ngày sinh',
	`IdentityCard` VARCHAR(255) COMMENT 'Số CCCD',
	`IDCardBefore` VARCHAR(255) COMMENT 'Ảnh mặt trước CCCD',
	`IDCardAfter` VARCHAR(255) COMMENT 'Ảnh mặt sau CCCD',
	`Sex` INTEGER COMMENT 'Giới tính (0: Nam, 1: Nữ)',
	`CreatedAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo tài khoản',
	`AccountID` INTEGER,
	`TotalOrdered` INTEGER COMMENT 'Tổng số lần thuê xe',
	`TotalFine` INTEGER COMMENT 'Tổng số lần bị phạt',
	`TotalAmount` DOUBLE COMMENT 'Tổng số tiền',
	`Active` INTEGER DEFAULT 1 COMMENT 'Trạng thái khách hàng (0: Chưa kích hoạt, 1: Đã kích hoạt)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`CustomerID`)
) COMMENT 'Thông tin khách hàng';

CREATE TABLE `Address` (
	`AddressID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`CustomerID` INTEGER COMMENT 'Mã khách hàng',
	`Address` VARCHAR(255),
	`Ward` VARCHAR(255),
	`District` VARCHAR(255),
	`Province` VARCHAR(255),
	`Is_Primary` INTEGER COMMENT 'Địa chỉ mặc định',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`AddressID`)
) 	COMMENT 'Địa chỉ người dùng';

CREATE TABLE `Reviews` (
	`ReviewID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`CustomerID` INTEGER COMMENT 'Mã khách hàng',
	`VehicleID` INTEGER,
	`Rating` INTEGER,
	`Comment` VARCHAR(255),
	`ReviewDate` DATETIME,
	PRIMARY KEY(`ReviewID`)
) COMMENT 'Đánh giá xe';


CREATE TABLE `Roles` (
	`RoleID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`RoleName` VARCHAR(255),
	PRIMARY KEY(`RoleID`)
) COMMENT 'Vai trò (Admin, Nhân viên)';


CREATE TABLE `Permissions` (
	`PermissionID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`PermissionName` VARCHAR(255),
	`Description` VARCHAR(255),
	PRIMARY KEY(`PermissionID`)
) COMMENT 'Quyền hạn (Thêm, Sửa, Xóa, Xem, thuê xe, kiểm tra xe)';

CREATE TABLE `Functions` (
	`FunctionID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`FunctionName` VARCHAR(255),
	`Description` VARCHAR(255),
	PRIMARY KEY(`FunctionID`)
) COMMENT 'Chức năng (Quản lý xe, Quản lý đơn hàng, Quản lý khách hàng, Quản lý nhân viên)';

CREATE TABLE `RolePermissions` (
	`RolePermissionID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`RoleID` INTEGER,
	`FunctionID` INTEGER COMMENT 'Mã chức năng',
	`PermissionID` INTEGER COMMENT 'Mã quyền hạn',
	PRIMARY KEY(`RolePermissionID`)
) COMMENT 'Phân quyền';

CREATE TABLE `Inspections` (
	`InspectionID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`RentalOrderDetailID` INTEGER,
	`InspectionDate` DATE COMMENT 'Ngày kiểm tra sau khi thuê xe',
	`InspectionTime` TIME COMMENT 'Giờ kiểm tra sau khi thuê xe',
	`UserID` INTEGER COMMENT 'Mã người dùng (Nhân viên)',
	`TotalFineAmount` VARCHAR(255) COMMENT 'Tổng số tiền phạt',
	PRIMARY KEY(`InspectionID`)
) COMMENT 'Kiểm tra xe trước khi thuê và sau khi trả xe';

CREATE TABLE `DamageDetails` (
	`DamageDetailID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`InspectionID` INTEGER COMMENT 'Mã Inspections (nếu có)',
	`Image` VARCHAR(255) COMMENT 'Hình ảnh tình trạng sau khi xe',
	`DamageTypeID` INTEGER COMMENT 'Mã loại hỏng hóc',
	`Description` VARCHAR(255) COMMENT 'Mô tả',
	PRIMARY KEY(`DamageDetailID`)
) COMMENT 'Chi tiết hỏng hóc sau khi trả xe';


CREATE TABLE `VehicleCondition` (
	`ConditionID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE COMMENT 'Mã tình trạng xe', 
	`InspectionID` INTEGER COMMENT 'Mã tình trạng xe trước khi thuê',
	`Description` VARCHAR(255) COMMENT 'Mô tả',
	`Image` VARCHAR(255) COMMENT 'Hình ảnh',
	`Status` INTEGER DEFAULT 0 COMMENT 'Trạng thái (0: Chưa kiểm tra, 1: Đã kiểm tra)',
	PRIMARY KEY(`ConditionID`)
) COMMENT 'Tình trạng xe trước khi thuê';

CREATE TABLE `DamageTypes` (
	`DamageTypeID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`DamageName` VARCHAR(255),
	`FineAmount` DOUBLE COMMENT 'Số tiền phạt',
	`VehicleTypesID` INTEGER COMMENT 'Mã loại xe áp dụng cho xe nào (Hạng sang, tầm trung, phổ thông)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`DamageTypeID`)
) COMMENT 'Loại hỏng hóc cố định cụ thể (Xước xe tầm trung: 200k, Xước xe hạng sang: 500k)';




-- CREATE TABLE `ImagesInspect` (
-- 	`ImagesInspectID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
-- 	`InspectionID` INTEGER COMMENT 'Mã kiểm tra',
-- 	`ImageURL` INTEGER COMMENT 'Đường dẫn ảnh',
-- 	PRIMARY KEY(`ImagesInspectID`)
-- ) COMMENT 'Hình ảnh kiểm tra xe';


CREATE TABLE `Accounts` (
	`AccountID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`Username` VARCHAR(255),
	`Password` VARCHAR(255),
	`Token` VARCHAR(255),
	`OTP` VARCHAR(255) COMMENT 'Mã OTP',
	`ProfilePicture` VARCHAR(255) COMMENT 'Ảnh đại diện',
	`GoogleID` VARCHAR(255) COMMENT 'ID người dùng từ Google',
	`CreatedAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo tài khoản',
	`Email` VARCHAR(255),
	`RoleID` INTEGER,
	`Active` INTEGER DEFAULT 1 COMMENT 'Trạng thái tài khoản (0: Chưa kích hoạt, 1: Đã kích hoạt)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`AccountID`)
) COMMENT 'Tài khoản';

CREATE TABLE `Promotions` (
	`PromotionID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE COMMENT 'Mã khuyến mãi (0: Không có)', 
	`PromotionName` VARCHAR(255) COMMENT 'Tên khuyến mãi',
	`PromotionCode` VARCHAR(255) COMMENT 'Mã khuyến mãi',
	`VehicleID` INTEGER COMMENT 'Mã xe (nếu có)',
	`DiscountType` INTEGER COMMENT 'Loại giảm giá (0: %, 1: Số tiền)',
	`DiscountValue` DOUBLE COMMENT 'Giá trị giảm giá',
	`CreateAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
	`UserID` INTEGER COMMENT 'Mã người dùng tạo',
	`StartDate` DATE COMMENT 'Ngày bắt đầu',
	`EndDate` DATE COMMENT 'Ngày kết thúc',
	`Description` VARCHAR(255) COMMENT 'Mô tả',
	`Status` INTEGER DEFAULT 1 COMMENT 'Trạng thái (0: Chưa áp dụng, 1: Đã áp dụng)',
	`Is_Delete` INTEGER DEFAULT 0 COMMENT 'Xóa',
	PRIMARY KEY(`PromotionID`)

) COMMENT 'Khuyến mãi';


ALTER TABLE `Address`
ADD FOREIGN KEY(`CustomerID`) REFERENCES `Customers`(`CustomerID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RentalOrderDetails`
ADD FOREIGN KEY(`OrderID`) REFERENCES `RentalOrders`(`OrderID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RentalOrders`
ADD FOREIGN KEY(`UserID`) REFERENCES `Users`(`UserID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RentalOrders`
ADD FOREIGN KEY(`CustomerID`) REFERENCES `Customers`(`CustomerID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Models`
ADD FOREIGN KEY(`VehicleTypesID`) REFERENCES `VehicleTypes`(`VehicleTypesID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Reviews`
ADD FOREIGN KEY(`VehicleID`) REFERENCES `Vehicles`(`VehicleID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Reviews`
ADD FOREIGN KEY(`CustomerID`) REFERENCES `Customers`(`CustomerID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RolePermissions`
ADD FOREIGN KEY(`RoleID`) REFERENCES `Roles`(`RoleID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RolePermissions`
ADD FOREIGN KEY(`PermissionID`) REFERENCES `Permissions`(`PermissionID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RentalOrderDetails`
ADD FOREIGN KEY(`UserID`) REFERENCES `Users`(`UserID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Inspections`
ADD FOREIGN KEY(`UserID`) REFERENCES `Users`(`UserID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `DamageDetails`
ADD FOREIGN KEY(`DamageTypeID`) REFERENCES `DamageTypes`(`DamageTypeID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `DamageTypes`
ADD FOREIGN KEY(`VehicleTypesID`) REFERENCES `VehicleTypes`(`VehicleTypesID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RentalOrders`
ADD FOREIGN KEY(`PaymentID`) REFERENCES `Payments`(`PaymentID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RentalOrderDetails`
ADD FOREIGN KEY(`VehicleDetailID`) REFERENCES `VehicleDetails`(`VehicleDetailID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Inspections`
ADD FOREIGN KEY(`RentalOrderDetailID`) REFERENCES `RentalOrderDetails`(`OrderDetailID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `VehicleCondition`
ADD FOREIGN KEY(`InspectionID`) REFERENCES `Inspections`(`InspectionID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `DamageDetails`
ADD FOREIGN KEY(`InspectionID`) REFERENCES `Inspections`(`InspectionID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
-- ALTER TABLE `ImagesInspect`
-- ADD FOREIGN KEY(`InspectionID`) REFERENCES `Inspections`(`InspectionID`)
-- ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Users`
ADD FOREIGN KEY(`AccountID`) REFERENCES `Accounts`(`AccountID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Customers`
ADD FOREIGN KEY(`AccountID`) REFERENCES `Accounts`(`AccountID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Accounts`
ADD FOREIGN KEY(`RoleID`) REFERENCES `Roles`(`RoleID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Vehicles`
ADD FOREIGN KEY(`MakeID`) REFERENCES `Makes`(`MakeID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Vehicles`
ADD FOREIGN KEY(`ModelID`) REFERENCES `Models`(`ModelID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Vehicles`
ADD FOREIGN KEY(`VehicleTypesID`) REFERENCES `VehicleTypes`(`VehicleTypesID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `VehicleDetails`
ADD FOREIGN KEY(`VehicleID`) REFERENCES `Vehicles`(`VehicleID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `VehicleImages`
ADD FOREIGN KEY(`VehicleDetailID`) REFERENCES `VehicleDetails`(`VehicleDetailID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `VehicleImages`
ADD FOREIGN KEY(`VehicleID`) REFERENCES `Vehicles`(`VehicleID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `VehicleDetails`
ADD FOREIGN KEY(`ColorID`) REFERENCES `Colors`(`ColorID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Vehicles`
ADD FOREIGN KEY(`PromotionID`) REFERENCES `Promotions`(`PromotionID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RentalOrders`
ADD FOREIGN KEY(`PromotionID`) REFERENCES `Promotions`(`PromotionID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Promotions`
ADD FOREIGN KEY(`UserID`) REFERENCES `Users`(`UserID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `RolePermissions`
ADD FOREIGN KEY(`FunctionID`) REFERENCES `Functions`(`FunctionID`)
ON UPDATE NO ACTION ON DELETE NO ACTION;

-- INSERT DATA
-- Nhập dữ liệu cho bảng Permissions
INSERT INTO `Permissions` (`PermissionName`, `Description`) 
VALUES 
('Thêm', 'Thêm mới dữ liệu'),
('Sửa', 'Chỉnh sửa dữ liệu'),
('Xóa', 'Xóa dữ liệu'),
('Xem', 'Xem dữ liệu'),
('Duyệt đơn hàng', 'Duyệt đơn hàng'),
('Kiểm tra xe', 'Kiểm tra tình trạng xe'),
('Báo cáo', 'Xem báo cáo');

-- Nhập dữ liệu cho bảng Functions
INSERT INTO `Functions` (`FunctionName`, `Description`)
VALUES 
('dashboard', 'Quản lý thông tin tổng quan'),  -- 1
('approval', 'Duyệt đơn hàng xe'), -- 2
('inspector', 'Duyệt kiểm tra xe'), -- 3
('vehicle', 'Quản lý xe'), -- 4
('vehiclecategory','Quản lý loại xe'), -- 5
('colors', 'Quản lý màu xe'), -- 6
('makes', 'Quản lý hãng xe'), -- 7
('models', 'Quản lý mẫu xe'), -- 8
('rentalorders', 'Quản lý đơn hàng thuê xe'), -- 9
('inspections', 'Quản lý kiểm tra xe'), -- 10
('damagetypes', 'Quản lý loại hỏng hóc'), -- 11
('deposits', 'Quản lý đặt cọc'), -- 12
('reviews', 'Quản lý đánh giá'), -- 13
('payments', 'Quản lý thanh toán'), -- 14
('promotions', 'Quản lý khuyến mãi'), -- 15
('users', 'Quản lý người dùng'), -- 16
('customers', 'Quản lý khách hàng'), -- 17
('permissions', 'Quản lý phân quyền linh động'); -- 18

-- Nhập dữ liệu cho bảng Roles
INSERT INTO `Roles` (`RoleID`,`RoleName`) 
VALUES (0,'Customer');

INSERT INTO `Roles` (`RoleName`) 
VALUES ('Admin'), ('Nhân viên'), ('Nhân viên duyệt đơn'), ('Nhân viên kiểm tra xe');

-- Nhập dữ liệu cho bảng RolePermissions
INSERT INTO `RolePermissions` (`RoleID`, `FunctionID`, `PermissionID`)
VALUES 
		-- ADMIN
		(1,1,7),
		(1,2,5),
		(1,3,6),
		(1,4,1), (1,4,2),(1,4,3),(1,4,4),
		(1,5,1),(1,5,2),(1,5,3),(1,5,4),
		(1,6,1),(1,6,2),(1,6,3),(1,6,4),
		(1,7,1),(1,7,2),(1,7,3),(1,7,4),
		(1,8,1),(1,8,2),(1,8,3),(1,8,4),
		(1,9,1),(1,9,2),(1,9,3),(1,9,4),
		(1,10,1),(1,10,2),(1,10,3),(1,10,4),
		(1,11,1),(1,11,2),(1,11,3),(1,11,4),
		(1,12,1),(1,12,2),(1,12,3),(1,12,4),
		(1,13,1),(1,13,2),(1,13,3),(1,13,4),
		(1,14,1),(1,14,2),(1,14,3),(1,14,4),
		(1,15,1),(1,15,2),(1,15,3),(1,15,4),
		(1,16,1),(1,16,2),(1,16,3),(1,16,4),
		(1,17,1),(1,17,2),(1,17,3),(1,17,4),
		(1,18,1),(1,18,2),(1,18,3),(1,18,4);

-- Nhập dữ liệu cho bảng Accounts
INSERT INTO `Accounts` (`Username`, `Password`,`Token`,`ProfilePicture`,`GoogleID`, `Email`, `RoleID`)
VALUES 
('admin', '$2y$10$F3FQFNZwijEhnKf4EVrkVeaJNtW0icztly.M4sNrHn2GDsT1DsARy',NULL,NULL,NULL, 'quoctien01062003@gmail.com',1);

-- Nhập dữ liệu cho bảng Users
INSERT INTO `Users` (`FullName`, `PhoneNumber`, `Sex`, `IdentityCard`, `DateOfBirth`, `AccountID`, `Active`, `Is_Delete`)
VALUES 
('Quoc Tien', '0961234567', 0, '123456789102', '2003-06-01', 1, 1, 0);


-- Thêm dữ liệu vào bảng Makes
INSERT INTO `Makes` (`MakeName`, `Country`) 
VALUES ('Toyota', 'Japan'), ('Honda', 'Japan'), ('Ford', 'USA');

-- Thêm dữ liệu vào bảng VehicleTypes
INSERT INTO `VehicleTypes` (`NameType`) 
VALUES ('Hạng sang'), ('Tầm trung'), ('Phổ thông');

-- Thêm dữ liệu vào bảng Models
INSERT INTO `Models` (`ModelName`, `MakeID`, `VehicleTypesID`) 
VALUES ('Camry', 1, 2), ('Civic', 2, 2), ('Mustang', 3, 1);

-- Thêm dữ liệu vào bảng Colors
INSERT INTO `Colors` (`ColorName`) 
VALUES ('Đen'), ('Trắng'), ('Đỏ'),('Bạc');

-- Thêm giá trị mặc định "Không có khuyến mãi"
INSERT INTO `Promotions` (`PromotionID`, `PromotionName`, `PromotionCode`, `Description`, `Status`, `Is_Delete`) 
VALUES (0, 'Không có khuyến mãi', 'NO_PROMO', 'Không áp dụng khuyến mãi', 1, 0);

-- Thêm dữ liệu vào bảng Vehicles
INSERT INTO `Vehicles` (`MakeID`, `ModelID`, `Seats`, `VehicleTypesID`, `HourlyPrice`, `DailyPrice`, `WeeklyPrice`, `MonthlyPrice`, `Quantity`, `Description`, `Is_Feature`, `PromotionID`, `Is_Delete`) 
VALUES 
(1, 1, 5, 2, 10.5, 70, 450, 1500, 10, 'Toyota Camry tầm trung, tiết kiệm xăng', 1, 0, 0),
(2, 2, 5, 2, 9, 60, 400, 1400, 8, 'Honda Civic phong cách thể thao', 0, 0, 0),
(3, 3, 4, 1, 20, 150, 950, 3500, 5, 'Ford Mustang mạnh mẽ, đẳng cấp',1, 0, 0);

-- Thêm dữ liệu vào VehicleDetails với giá chênh lệch từ 2-5% so với mặc định
INSERT INTO `VehicleDetails` (
    `VehicleID`, `ColorID`, `LicensePlateNumber`, `Mileage`, `Year`, `Transmission`, `FuelType`,
    `HourlyPrice`, `DailyPrice`, `WeeklyPrice`, `MonthlyPrice`,
    `FuelConsumption`, `Active`, `Is_Delete`
) VALUES 
-- VehicleID = 1 (giá gốc: 10.5 | 70 | 450 | 1500)
(1, 1, '59A12345', 10000, 2020, 'Tự động', 'Xăng', 10.8, 72, 459, 1530, '5.5', 1, 0),
(1, 1, '59A12350', 15000, 2021, 'Tự động', 'Xăng', 10.71, 71.4, 456, 1515, '5.5', 1, 0),
(1, 1, '59A12351', 25000, 2022, 'Tự động', 'Xăng', 10.29, 68.6, 441, 1470, '5.5', 1, 0),
(1, 1, '59A12352', 35000, 2023, 'Tự động', 'Xăng', 10.71, 71.4, 459, 1515, '5.5', 1, 0),
(1, 1, '59A12353', 45000, 2024, 'Tự động', 'Xăng', 10.29, 68.6, 441, 1470, '5.5', 1, 0),
(1, 2, '59A12346', 20000, 2019, 'Tự động', 'Xăng', 10.71, 71.4, 459, 1515, '5.5', 1, 0),
(1, 2, '59A12354', 10000, 2020, 'Tự động', 'Xăng', 10.29, 68.6, 441, 1470, '5.5', 1, 0),
(1, 2, '59A12355', 15000, 2021, 'Tự động', 'Xăng', 10.5, 70, 450, 1500, '5.5', 1, 0),
(1, 2, '59A12356', 25000, 2022, 'Tự động', 'Xăng', 10.71, 71.4, 459, 1515, '5.5', 1, 0),
(1, 2, '59A12357', 35000, 2023, 'Tự động', 'Xăng', 10.5, 70, 450, 1500, '5.5', 1, 0),
(1, 2, '59A12358', 45000, 2024, 'Tự động', 'Xăng', 10.29, 68.6, 441, 1470, '5.5', 1, 0),
(1, 2, '59A12359', 50000, 2025, 'Tự động', 'Xăng', 10.8, 72, 459, 1530, '5.5', 1, 0),

-- VehicleID = 2 (giá gốc: 9 | 60 | 400 | 1400)
(2, 3, '59A12347', 30000, 2018, 'Tự động', 'Xăng', 9.36, 62.4, 408, 1430, '5.5', 1, 0),

-- VehicleID = 3 (giá gốc: 20 | 150 | 950 | 3500)
(3, 1, '59A12348', 40000, 2017, 'Tự động', 'Xăng', 20.4, 153, 969, 3570, '5.5', 1, 0),
(3, 1, '59A12349', 50000, 2016, 'Tự động', 'Xăng', 19.8, 147, 931, 3430, '5.5', 1, 0),
(3, 1, '59A12360', 60000, 2015, 'Tự động', 'Xăng', 20.2, 151.5, 969, 3540, '5.5', 1, 0),
(3, 1, '59A12361', 70000, 2014, 'Tự động', 'Xăng', 19.6, 145.5, 931, 3430, '5.5', 1, 0),
(3, 1, '59A12362', 80000, 2013, 'Tự động', 'Xăng', 20.4, 153, 969, 3570, '5.5', 1, 0),
(3, 1, '59A12363', 90000, 2012, 'Tự động', 'Xăng', 20.2, 151.5, 950, 3540, '5.5', 1, 0),
(3, 1, '59A12364', 100000, 2011, 'Tự động', 'Xăng', 19.6, 147, 931, 3430, '5.5', 1, 0);



-- Thêm dữ liệu vào bảng DamageTypes
INSERT INTO `DamageTypes` (`DamageName`, `FineAmount`, `VehicleTypesID`, `Is_Delete`)
VALUES 
('Xước nhẹ', 200, 1, 0),
('Xước nhẹ', 150, 2, 0),
('Xước nhẹ', 100, 3, 0),

('Xước nặng', 500, 1, 0),
('Xước nặng', 400, 2, 0),
('Xước nặng', 300, 3, 0),

('Hỏng đèn', 300, 1, 0),
('Hỏng đèn', 200, 2, 0),
('Hỏng đèn', 100, 3, 0),

('Hỏng cửa', 400, 1, 0),
('Hỏng cửa', 300, 2, 0),
('Hỏng cửa', 200, 3, 0),

('Móp biển số', 200, 1, 0),
('Móp biển số', 100, 2, 0),
('Móp biển số', 50, 3, 0);

