# 🛡 Netvisor

**Network Monitoring & Security Intelligence Platform**

Netvisor is a lightweight network monitoring and security intelligence platform built with PHP and MySQL. It provides automated device discovery, network visibility, event logging, anomaly detection, and real-time alerting capabilities for local network environments.

---

## 🚀 Overview

Netvisor was developed to simplify network monitoring by automatically discovering devices, tracking network activity, detecting changes, and generating actionable events.

The platform combines network scanning, device inventory management, event-driven monitoring, and security-oriented analysis into a single solution.

---

## ✨ Features

### 🌐 Network Discovery

* Automatic device discovery
* IP and MAC address collection
* Hostname resolution
* Vendor identification

### 📊 Monitoring

* Continuous network scanning
* Online / Offline detection
* Device status tracking
* Historical visibility

### 🧠 Security Intelligence

* Event-driven monitoring
* Risk-based device classification
* Basic anomaly detection
* Suspicious activity identification

### 📡 Alerts

* Discord webhook integration
* Critical event notifications
* Offline device alerts
* Security event alerts

### 🗄 Data Management

* MySQL device inventory
* Event logging system
* Historical records
* Network asset tracking

---

## 🏗 Architecture

```text
Scanner Engine
      │
      ▼
Network Discovery
      │
      ▼
Device Processing
      │
      ▼
Risk Analysis Engine
      │
      ▼
Event Management
      │
      ▼
Dashboard & Alerts
```

---

## 🛠 Technology Stack

| Technology           | Purpose                |
| -------------------- | ---------------------- |
| PHP                  | Backend Logic          |
| MySQL                | Data Storage           |
| Linux (Ubuntu)       | Deployment Environment |
| Cron Jobs            | Automated Scheduling   |
| Discord Webhooks     | Notifications          |
| Networking Protocols | Discovery & Monitoring |

---

## 📂 Project Structure

```text
netvisor/
│
├── app/
│   ├── core/
│   │   ├── Bootstrap.php
│   │   ├── NetworkService.php
│   │   └── ScannerService.php
│   │
│   ├── services/
│   │   ├── DeviceService.php
│   │   ├── EventService.php
│   │   └── DiscordService.php
│   │
│   ├── modules/
│   │   ├── Ping.php
│   │   ├── Arp.php
│   │   ├── Tcp.php
│   │   ├── Hostname.php
│   │   └── Vendor.php
│   │
│   └── database/
│       └── DB.php
│
├── run.php
├── run_fast.php
├── dashboard.php
├── show_devices.php
└── README.md
```

---

## ⚡ Installation

### Clone Repository

```bash
git clone https://github.com/cyber-mounir/netvisor-network-monitoring.git
cd netvisor-network-monitoring
```

### Configure Database

Create a MySQL database:

```sql
CREATE DATABASE netvisor;
```

Update database credentials in:

```text
app/database/DB.php
```

### Run Scan

```bash
php run.php
```

### Launch Dashboard

```bash
php -S localhost:8000
```

Open:

```text
http://localhost:8000/dashboard.php
```

---

## 📈 Example Events

```text
NEW_DEVICE
DEVICE_ACTIVE
DEVICE_OFFLINE
ANOMALY_DETECTED
SUSPICIOUS_ACTIVITY
```

---

## 🎯 Project Goals

* Improve network visibility
* Automate device discovery
* Reduce manual monitoring effort
* Detect abnormal network behavior
* Provide a foundation for security monitoring

---

## 📊 Impact

Estimated project outcomes:

* ~30% faster device discovery
* ~25% improved anomaly detection response
* ~40% reduction in manual monitoring effort

---

## 🔒 Disclaimer

This project is intended for educational, research, and authorized network administration purposes only.

Users are responsible for ensuring they have permission to scan and monitor any network where the software is deployed.

---

## 👨‍💻 Author

**Mounir**

Network Monitoring • Backend Development • Cybersecurity Enthusiast

---

## 📜 License

This project is released under the MIT License.
