# 🚓 E-Vehicle Challan Management System

A secure and scalable backend system to digitize and streamline traffic challan management for electric vehicles. This project simulates a real-world government-grade application handling user data, traffic violations, payments, and compliance tracking — all powered by PHP and MySQL.

---

## 🧠 Problem Statement

Traffic violation records in many cities are still handled manually or via outdated legacy systems, leading to inefficiencies and data inconsistency.

This project provides a **paperless digital alternative** with:
- Real-time challan generation
- Automated fine calculations
- Secure driver & vehicle data storage
- Integration-ready design for police dashboards and user portals

---

## ⚙️ Key Features

- 🔐 **Role-based Access** for Admins and Common Users
- 🧾 **Fine Issuance** for multiple traffic violations
- 💳 **Online Fine Payment Tracking**
- 📋 **Complaints Module** for users to dispute challans
- 📁 **Driver & Vehicle Database**
- 🧼 **Data Validations** to ensure clean entries
- 🧠 **Modular Backend** with minimal coupling and scalable structure

---

## 🏗️ Architecture Overview

- **Backend Language:** PHP (Procedural with Modularization)
- **Database:** MySQL with InnoDB & Foreign Keys
- **Security:** Input validation, SQL sanitization, session handling
- **Tools Used:** XAMPP, phpMyAdmin
- **Codebase:** Structured into `admin/`, `user/`, `db/`, `assets/`, and `core/` for separation of concerns

---

## 📊 Database Schema (Simplified ERD)

```text
[COMMONUSERS]───┐
                │
[DRIVERINFO]────┼────>[VEHICLEINFO]────>[VIOLATIONS]────>[FINESPAID]
                │
        [INSURANCEDETAILS]
        [POLLUTIONCERTIFICATE]
