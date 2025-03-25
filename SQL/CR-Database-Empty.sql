CREATE TABLE `Vehicles` (
	`VehicleID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`MakeID` INTEGER COMMENT 'Mã hãng xe', 
	`ModelID` INTEGER COMMENT ' Mã mẫu xe',
	`Seats` INTEGER COMMENT 'Số chỗ ngồi',
	`VehicleTypesID` INTEGER COMMENT 'Loại xe (Hạng sang, tầm trung, phổ thông)',
	`HourlyPrice` DOUBLE COMMENT 'Giá thuê theo giờ',
	`DailyPrice` DOUBLE COMMENT 'Giá thuê theo ngày',
	`WeeklyPrice` DOUBLE COMMENT 'Giá thuê theo tuần',
	`MonthlyPrice` DOUBLE COMMENT 'Giá thuê theo tháng',
	`Quantity` INTEGER COMMENT 'Tổng số lượng xe hãng và mẫu',
	`Description` VARCHAR(500) COMMENT 'Mô tả',	
	`Status` INTEGER COMMENT 'Trạng thái hết chưa hay còn (0: Hết, 1: Còn)',
	`Is_Feature` INTEGER COMMENT 'Xe nổi bật',
	`PromotionID` INTEGER COMMENT 'Mã khuyến mãi',
	`Is_Delete` INTEGER COMMENT 'Xóa',
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
	`FuelConsumption` VARCHAR(255) COMMENT 'Mức tiêu hao nhiên liệu (L/100km)',
	`Status` INTEGER COMMENT 'Trạng thái xe (0: Đang thuê, 1: Đang trống)',
	`Is_Delete` INTEGER COMMENT 'Xóa',
	PRIMARY KEY(`VehicleDetailID`)
) COMMENT 'Thông tin chi tiết xe';

CREATE TABLE `VehicleImages` (
	`ImageID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`VehicleID` INTEGER COMMENT 'Mã chi tiết xe liên kết Vehicles',
	`ImageURL` VARCHAR(255) COMMENT 'Đường dẫn ảnh',
	`IsPrimary` INTEGER COMMENT 'Ảnh chính',
	PRIMARY KEY(`ImageID`)
) COMMENT 'Hình ảnh xe';

CREATE TABLE `VehicleTypes` (
	`VehicleTypesID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`NameType` VARCHAR(255) COMMENT 'Tên loại xe (Hạng sang, tầm trung, phổ thông)',
	PRIMARY KEY(`VehicleTypesID`)
) COMMENT 'Loại xe (Hạng sang, tầm trung, phổ thông)';

CREATE TABLE `Colors` (
	`ColorID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`ColorName` VARCHAR(255) COMMENT 'Tên màu',
	PRIMARY KEY(`ColorID`)
) COMMENT 'Màu xe';

CREATE TABLE `Makes` (
	`MakeID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`MakeName` VARCHAR(255) COMMENT 'Tên hãng xe',
	`Country` VARCHAR(255) COMMENT 'Quốc gia',

	PRIMARY KEY(`MakeID`)
) COMMENT 'Hãng xe (Toyota, Honda, Ford, ...)';

CREATE TABLE `Models` (
	`ModelID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,       
	`ModelName` VARCHAR(255) COMMENT 'Tên mẫu xe',           
	`MakeID` INTEGER COMMENT 'Mã hãng xe',                                        
	`VehicleType` INTEGER COMMENT 'Loại xe (Hạng sang, tầm trung, phổ thông)',
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
	`Status` INTEGER COMMENT 'Trạng thái đơn hàng (0: Chưa trả xe, 1: Đã trả xe)',
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
	`Active` INTEGER COMMENT 'Khách hàng đã gia hạn thuê thêm vài ngày nữa chưa? 
0 - Chưa gia hạn (Hiện thị nút Gia hạn)
1 - Đã gia hạn rồi (Ẩn nút Gia Hạn)',
	`Status` INTEGER COMMENT 'trạng thái trả xe chưa? (0: Chưa trả xe, 1: Đã trả xe)',
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
	`Active` INTEGER COMMENT 'Trạng thái đặt cọc (0: Chưa nhận cọc, 1: Đã nhận cọc)',
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
	`Status` INTEGER COMMENT 'Trạng thái thanh toán (0: Chưa thanh toán, 1: Đã thanh toán)',
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
	`Active` INTEGER COMMENT 'Trạng thái tài khoản (0: Chưa kích hoạt, 1: Đã kích hoạt)',
	`Is_Delete` INTEGER COMMENT 'Xóa',
	PRIMARY KEY(`UserID`)
) COMMENT 'Thông tin người dùng';

CREATE TABLE `Customers` (
	`CustomerID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE COMMENT 'Mã khách hàng (CCCD)',
	`FullName` VARCHAR(255) COMMENT 'Họ tên',
	`PhoneNumber` VARCHAR(255) COMMENT 'Số điện thoại',
	`Email` VARCHAR(255) COMMENT 'Email',
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
	`Active` INTEGER COMMENT 'Trạng thái khách hàng (0: Chưa kích hoạt, 1: Đã kích hoạt)',
	`Is_Delete` INTEGER COMMENT 'Xóa',
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
	`Is_Delete` INTEGER COMMENT 'Xóa',
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
	`Status` INTEGER,
	PRIMARY KEY(`ConditionID`)
) COMMENT 'Tình trạng xe trước khi thuê';

CREATE TABLE `DamageTypes` (
	`DamageTypeID` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`DamageName` VARCHAR(255),
	`FineAmount` DOUBLE COMMENT 'Số tiền phạt',
	`VehicleTypesID` INTEGER COMMENT 'Mã loại xe áp dụng cho xe nào (Hạng sang, tầm trung, phổ thông)',
	`Is_Delete` INTEGER COMMENT 'Xóa',
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
	`ProfilePicture` VARCHAR(255) COMMENT 'Ảnh đại diện',
	`GoogleID` VARCHAR(255) UNIQUE COMMENT 'ID người dùng từ Google',
	`CreatedAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo tài khoản',
	`Email` VARCHAR(255),
	`RoleID` INTEGER,
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
	`Status` INTEGER COMMENT 'Trạng thái (0: Chưa áp dụng, 1: Đã áp dụng)',
	`Is_Delete` INTEGER COMMENT 'Xóa',
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
ADD FOREIGN KEY(`VehicleType`) REFERENCES `VehicleTypes`(`VehicleTypesID`)
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

