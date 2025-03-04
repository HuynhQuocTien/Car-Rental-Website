-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 04, 2025 at 03:14 AM
-- Server version: 9.2.0
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-rental-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `AddressID` int NOT NULL,
  `CustomerID` int DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Ward` varchar(255) DEFAULT NULL,
  `District` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `CustomerID` int NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `IdentityCard` varchar(255) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `Status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `DamageDetails`
--

CREATE TABLE `DamageDetails` (
  `DamageDetailID` int NOT NULL,
  `DamageTypeID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `DamageTypes`
--

CREATE TABLE `DamageTypes` (
  `DamageTypeID` int NOT NULL,
  `DamageName` varchar(255) DEFAULT NULL,
  `FineAmount` double DEFAULT NULL,
  `VehicleTypesID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ImagesInspect`
--

CREATE TABLE `ImagesInspect` (
  `Id` int NOT NULL,
  `InspectionID` int DEFAULT NULL,
  `ImageURL` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Inspections`
--

CREATE TABLE `Inspections` (
  `InspectionID` int NOT NULL,
  `RentalOrderDetailID` int DEFAULT NULL,
  `InspectionDate` date DEFAULT NULL,
  `ConditionBefore` varchar(255) DEFAULT NULL,
  `ConditionAfter` varchar(255) DEFAULT NULL,
  `DamageID` int DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `TotalFineAmount` varchar(255) DEFAULT NULL,
  `ConditonID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

CREATE TABLE `Payments` (
  `PaymentID` int NOT NULL,
  `OrderID` int DEFAULT NULL,
  `PaymentDate` datetime DEFAULT NULL,
  `PaymentMethod` varchar(255) DEFAULT NULL,
  `Amount` double DEFAULT NULL,
  `Status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Permissions`
--

CREATE TABLE `Permissions` (
  `PermissionID` int NOT NULL,
  `PermissionName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RentalOrderDetails`
--

CREATE TABLE `RentalOrderDetails` (
  `OrderDetailID` int NOT NULL,
  `OrderID` int DEFAULT NULL,
  `VehiclesID` int DEFAULT NULL,
  `RentalRate` double DEFAULT NULL,
  `ReturnDate` datetime DEFAULT NULL,
  `ActualReturnDate` datetime DEFAULT NULL,
  `DamagePenalty` double DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `Active` int DEFAULT NULL COMMENT 'Khách hàng đã gia hạn thuê thêm vài ngày nữa chưa? \n0 - Chưa gia hạn (Hiện thị nút Gia hạn)\n1 - Đã gia hạn rồi (Ẩn nút Gia Hạn)\n',
  `Status` int DEFAULT NULL COMMENT 'trạng thái trả xe chưa\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RentalOrders`
--

CREATE TABLE `RentalOrders` (
  `OrderID` int NOT NULL,
  `CustomerID` int DEFAULT NULL,
  `VehicleID` int DEFAULT NULL,
  `ActualReturnDate` datetime DEFAULT NULL,
  `TotalAmount` double DEFAULT NULL,
  `DamagePenalty` double DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `PaymentID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `ReviewID` int NOT NULL,
  `CustomerID` int DEFAULT NULL,
  `VehiclesID` int DEFAULT NULL,
  `Rating` int DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `ReviewDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RolePermissions`
--

CREATE TABLE `RolePermissions` (
  `RolePermissionID` int NOT NULL,
  `RoleID` int DEFAULT NULL,
  `PermissionID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `RoleID` int NOT NULL,
  `RoleName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `RoleID` int DEFAULT NULL,
  `Active` int DEFAULT NULL,
  `Is_Delete` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `VehicleCondition`
--

CREATE TABLE `VehicleCondition` (
  `ConditionID` int NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `VehicleImages`
--

CREATE TABLE `VehicleImages` (
  `ImageID` int NOT NULL,
  `VehicleID` int DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `IsPrimary` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Vehicles`
--

CREATE TABLE `Vehicles` (
  `VehiclesID` int NOT NULL,
  `Make` varchar(255) DEFAULT NULL,
  `Model` varchar(255) DEFAULT NULL,
  `Year` int DEFAULT NULL,
  `LicensePlateNumber` varchar(255) DEFAULT NULL,
  `Color` varchar(255) DEFAULT NULL,
  `Mileage` float DEFAULT NULL,
  `VIN` varchar(255) DEFAULT NULL,
  `VehicleType` int DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `Is_Delete` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `VehicleTypes`
--

CREATE TABLE `VehicleTypes` (
  `VehicleTypesID` int NOT NULL,
  `NameType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`AddressID`),
  ADD UNIQUE KEY `AddressID` (`AddressID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `DamageDetails`
--
ALTER TABLE `DamageDetails`
  ADD PRIMARY KEY (`DamageDetailID`),
  ADD UNIQUE KEY `DamageDetailID` (`DamageDetailID`),
  ADD KEY `DamageTypeID` (`DamageTypeID`);

--
-- Indexes for table `DamageTypes`
--
ALTER TABLE `DamageTypes`
  ADD PRIMARY KEY (`DamageTypeID`),
  ADD UNIQUE KEY `DamageTypeID` (`DamageTypeID`),
  ADD KEY `VehicleTypesID` (`VehicleTypesID`);

--
-- Indexes for table `ImagesInspect`
--
ALTER TABLE `ImagesInspect`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `InspectionID` (`InspectionID`);

--
-- Indexes for table `Inspections`
--
ALTER TABLE `Inspections`
  ADD PRIMARY KEY (`InspectionID`),
  ADD UNIQUE KEY `InspectionID` (`InspectionID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `DamageID` (`DamageID`),
  ADD KEY `RentalOrderDetailID` (`RentalOrderDetailID`),
  ADD KEY `ConditonID` (`ConditonID`);

--
-- Indexes for table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD UNIQUE KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`PermissionID`),
  ADD UNIQUE KEY `PermissionID` (`PermissionID`);

--
-- Indexes for table `RentalOrderDetails`
--
ALTER TABLE `RentalOrderDetails`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD UNIQUE KEY `OrderDetailID` (`OrderDetailID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `VehiclesID` (`VehiclesID`);

--
-- Indexes for table `RentalOrders`
--
ALTER TABLE `RentalOrders`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `OrderID` (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD UNIQUE KEY `ReviewID` (`ReviewID`),
  ADD KEY `VehiclesID` (`VehiclesID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `RolePermissions`
--
ALTER TABLE `RolePermissions`
  ADD PRIMARY KEY (`RolePermissionID`),
  ADD UNIQUE KEY `RolePermissionID` (`RolePermissionID`),
  ADD KEY `RoleID` (`RoleID`),
  ADD KEY `PermissionID` (`PermissionID`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `RoleID` (`RoleID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `VehicleCondition`
--
ALTER TABLE `VehicleCondition`
  ADD PRIMARY KEY (`ConditionID`),
  ADD UNIQUE KEY `ConditionID` (`ConditionID`);

--
-- Indexes for table `VehicleImages`
--
ALTER TABLE `VehicleImages`
  ADD PRIMARY KEY (`ImageID`),
  ADD UNIQUE KEY `ImageID` (`ImageID`),
  ADD KEY `VehicleID` (`VehicleID`);

--
-- Indexes for table `Vehicles`
--
ALTER TABLE `Vehicles`
  ADD PRIMARY KEY (`VehiclesID`),
  ADD UNIQUE KEY `VehiclesID` (`VehiclesID`),
  ADD KEY `VehicleType` (`VehicleType`);

--
-- Indexes for table `VehicleTypes`
--
ALTER TABLE `VehicleTypes`
  ADD PRIMARY KEY (`VehicleTypesID`),
  ADD UNIQUE KEY `VehicleTypesID` (`VehicleTypesID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `AddressID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `CustomerID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DamageDetails`
--
ALTER TABLE `DamageDetails`
  MODIFY `DamageDetailID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DamageTypes`
--
ALTER TABLE `DamageTypes`
  MODIFY `DamageTypeID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ImagesInspect`
--
ALTER TABLE `ImagesInspect`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Inspections`
--
ALTER TABLE `Inspections`
  MODIFY `InspectionID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `PaymentID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `PermissionID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RentalOrderDetails`
--
ALTER TABLE `RentalOrderDetails`
  MODIFY `OrderDetailID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RentalOrders`
--
ALTER TABLE `RentalOrders`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `ReviewID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RolePermissions`
--
ALTER TABLE `RolePermissions`
  MODIFY `RolePermissionID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `RoleID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VehicleCondition`
--
ALTER TABLE `VehicleCondition`
  MODIFY `ConditionID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VehicleImages`
--
ALTER TABLE `VehicleImages`
  MODIFY `ImageID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Vehicles`
--
ALTER TABLE `Vehicles`
  MODIFY `VehiclesID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VehicleTypes`
--
ALTER TABLE `VehicleTypes`
  MODIFY `VehicleTypesID` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Address`
--
ALTER TABLE `Address`
  ADD CONSTRAINT `Address_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`);

--
-- Constraints for table `DamageDetails`
--
ALTER TABLE `DamageDetails`
  ADD CONSTRAINT `DamageDetails_ibfk_1` FOREIGN KEY (`DamageTypeID`) REFERENCES `DamageTypes` (`DamageTypeID`);

--
-- Constraints for table `DamageTypes`
--
ALTER TABLE `DamageTypes`
  ADD CONSTRAINT `DamageTypes_ibfk_1` FOREIGN KEY (`VehicleTypesID`) REFERENCES `VehicleTypes` (`VehicleTypesID`);

--
-- Constraints for table `ImagesInspect`
--
ALTER TABLE `ImagesInspect`
  ADD CONSTRAINT `ImagesInspect_ibfk_1` FOREIGN KEY (`InspectionID`) REFERENCES `Inspections` (`InspectionID`);

--
-- Constraints for table `Inspections`
--
ALTER TABLE `Inspections`
  ADD CONSTRAINT `Inspections_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `Inspections_ibfk_2` FOREIGN KEY (`DamageID`) REFERENCES `DamageDetails` (`DamageDetailID`),
  ADD CONSTRAINT `Inspections_ibfk_3` FOREIGN KEY (`RentalOrderDetailID`) REFERENCES `RentalOrderDetails` (`OrderDetailID`),
  ADD CONSTRAINT `Inspections_ibfk_4` FOREIGN KEY (`ConditonID`) REFERENCES `VehicleCondition` (`ConditionID`);

--
-- Constraints for table `RentalOrderDetails`
--
ALTER TABLE `RentalOrderDetails`
  ADD CONSTRAINT `RentalOrderDetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `RentalOrders` (`OrderID`),
  ADD CONSTRAINT `RentalOrderDetails_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `RentalOrderDetails_ibfk_3` FOREIGN KEY (`VehiclesID`) REFERENCES `Vehicles` (`VehiclesID`);

--
-- Constraints for table `RentalOrders`
--
ALTER TABLE `RentalOrders`
  ADD CONSTRAINT `RentalOrders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`),
  ADD CONSTRAINT `RentalOrders_ibfk_2` FOREIGN KEY (`PaymentID`) REFERENCES `Payments` (`PaymentID`);

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `Reviews_ibfk_1` FOREIGN KEY (`VehiclesID`) REFERENCES `Vehicles` (`VehiclesID`),
  ADD CONSTRAINT `Reviews_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`);

--
-- Constraints for table `RolePermissions`
--
ALTER TABLE `RolePermissions`
  ADD CONSTRAINT `RolePermissions_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `Roles` (`RoleID`),
  ADD CONSTRAINT `RolePermissions_ibfk_2` FOREIGN KEY (`PermissionID`) REFERENCES `Permissions` (`PermissionID`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `Roles` (`RoleID`);

--
-- Constraints for table `VehicleImages`
--
ALTER TABLE `VehicleImages`
  ADD CONSTRAINT `VehicleImages_ibfk_1` FOREIGN KEY (`VehicleID`) REFERENCES `Vehicles` (`VehiclesID`);

--
-- Constraints for table `Vehicles`
--
ALTER TABLE `Vehicles`
  ADD CONSTRAINT `Vehicles_ibfk_1` FOREIGN KEY (`VehicleType`) REFERENCES `VehicleTypes` (`VehicleTypesID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
