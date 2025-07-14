# ELocate - E-Waste Facility Locator System
## 📽️ Project Demo

[![Watch the demo](https://img.youtube.com/vi/WMB1Sm_S80k/0.jpg)](https://www.youtube.com/watch?v=WMB1Sm_S80k)

## 🌱 About ELocate

ELocate is a comprehensive E-Waste Management System designed to help individuals and businesses responsibly dispose of electronic waste. Our platform connects users with certified recycling facilities, tracks environmental impact, and promotes sustainable practices for a cleaner future.

## ✨ Key Features

### 🗺️ **Facility Locator**
- **Interactive Map Integration**: Find certified e-waste recycling facilities near you
- **Detailed Facility Information**: View capacity, contact details, and accepted items
- **Real-time Availability**: Check facility status and operating hours
- **Multi-location Support**: Coverage across Tamil Nadu with 34+ certified facilities

### 📊 **Environmental Impact Tracking**
- **Personal Dashboard**: Track your e-waste recycling contributions
- **Carbon Footprint Calculator**: Measure environmental benefits of recycling
- **Statistics Visualization**: Interactive charts showing global e-waste data
- **Rewards System**: Earn rewards based on recycling milestones

### 🚚 **Pickup Services**
- **Schedule Pickups**: Book convenient pickup times for your location
- **Multiple Device Support**: Handle various electronic items
- **Image Upload**: Visual documentation of items for pickup
- **Real-time Tracking**: Monitor pickup status and completion

### 📚 **Educational Resources**
- **E-Waste Guidelines**: Learn proper disposal methods and regulations
- **Environmental Impact Education**: Understand the consequences of improper disposal
- **Interactive Timeline**: Step-by-step recycling process visualization
- **FAQ Section**: Comprehensive answers to common questions

### 👥 **User Management**
- **Multi-role Support**: Separate dashboards for users, managers, and administrators
- **Secure Authentication**: Password-protected accounts with session management
- **Profile Management**: Track personal recycling history and achievements
- **Notification System**: Stay updated on pickup schedules and environmental tips

## 🛠️ Technology Stack

### Backend
- **PHP 7.4+**: Server-side logic and database interactions
- **MySQL**: Database management for users, facilities, and tracking data
- **Session Management**: Secure user authentication and authorization

### Frontend
- **Leaflet API**: Location services and facility mapping
- **HTML5/CSS3**: Modern, responsive web structure
- **Bootstrap 4.5**: Mobile-first responsive design framework
- **JavaScript (ES6)**: Interactive features and dynamic content
- **Font Awesome**: Professional icon library

### Additional Tools
- **XAMPP**: Local development environment

## 🚀 Installation & Setup

### Prerequisites
- XAMPP/WAMP/LAMP stack
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser (Chrome, Firefox, Safari, Edge)

### Installation Steps

1. **Clone or Download**
   ```bash
   git clone https://github.com/kalaiarasut/E-waste-facility-locator.git
   cd E-waste-facility-locator
   ```

2. **Setup XAMPP**
   - Start Apache and MySQL services
   - Place project files in `xampp/htdocs/Latest/`

3. **Database Configuration**
   - Create databases: `dt`, `pickup`
   - Import database schema (create tables for users, facilities, bookings)
   - Update connection settings in `server.php`:
     ```php
     $HOSTNAME='localhost';
     $USERNAME='root';
     $PASSWORD='';
     $DATABASE='DT';
     ```

4. **File Permissions**
   - Ensure `uploads/` directory has write permissions
   - Set appropriate permissions for image storage

5. **Access Application**
   - Open browser and navigate to `http://localhost/Latest/main.php`
   - Create user account or login with existing credentials

## 📁 Project Structure

```
Latest/
├── 📄 main.php                 # Homepage with hero section and navigation
├── 📄 about us.php             # About page with mission, vision, and impact calculator
├── 📄 facility.php             # E-waste facility locator and listings
├── 📄 pickup.php               # Pickup scheduling system
├── 📄 login.php                # User authentication system
├── 📄 signup.php               # User registration
├── 📄 dashboard.php            # User dashboard with booking management
├── 📄 tracker.php              # Environmental impact tracking
├── 📄 statistics.php           # Data visualization and charts
├── 📄 impact.php               # Educational content about e-waste impact
├── 📄 timeline.php             # Guidelines and process visualization
├── 📄 terms.php                # E-waste management rules and regulations
├── 📄 contactus.php            # Contact information and support
├── 📄 payment.php              # Payment processing for services
├── 📄 admin.php                # Administrative interface
├── 📄 server.php               # Database connection configuration
├── 🎨 main.css                 # Primary stylesheet
├── 🎨 Auth.css                 # Authentication page styles
├── 🎨 contactus.css            # Contact page specific styles
├── 🎨 responsive.css           # Mobile responsiveness
├── ⚡ script.js                # Main JavaScript functionality
├── ⚡ signup.js                # Registration form validation
├── 🖼️ images/                   # Image assets and facility photos
└── 📁 uploads/                 # User uploaded files storage
```

## 🌟 Core Functionality

### 1. **User Registration & Authentication**
- Secure user registration with email verification
- Password encryption and secure login
- Role-based access control (User/Manager/Admin)
- Session management and logout functionality

### 2. **Facility Management**
- Comprehensive database of 34+ certified facilities
- Real-time facility information updates
- Contact details and capacity information
- Geographic location mapping

### 3. **Pickup Scheduling**
- Multi-step booking form with validation
- Image upload for item documentation
- Facility selection based on location
- Email confirmations and notifications

### 4. **Environmental Tracking**
- Personal e-waste disposal tracking
- Carbon footprint reduction calculations
- Milestone-based reward system
- Historical data visualization

### 5. **Educational Portal**
- Interactive FAQ system
- E-waste impact awareness content
- Regulatory guidelines and compliance
- Best practices for disposal

## 📊 Database Schema

### Main Tables:
- **users**: User account information and authentication
- **signup**: Registration data and user profiles
- **managersignup**: Manager account details
- **pickup_requests**: Pickup scheduling and tracking
- **facilities**: Certified recycling facility information
- **user_stats**: Environmental impact tracking data

## 🎨 Features Showcase

### Interactive Elements
- **Collapsible FAQ**: Accordion-style question and answer sections
- **Image Carousels**: Facility photos and educational content
- **Form Validation**: Real-time input validation and error handling
- **Responsive Design**: Mobile-friendly interface across all devices

### User Experience
- **Intuitive Navigation**: Clear menu structure with breadcrumbs
- **Progress Tracking**: Visual indicators for booking and recycling progress
- **Feedback Systems**: User notifications and confirmation messages
- **Accessibility**: Screen reader compatible and keyboard navigation

## 🌍 Environmental Impact

### Supported E-Waste Categories
- **Computing Devices**: Laptops, desktops, tablets, smartphones
- **Entertainment**: Televisions, game consoles, audio equipment
- **Office Equipment**: Printers, scanners, monitors, keyboards
- **Small Appliances**: Kitchen electronics, cables, batteries
- **Components**: Motherboards, RAM, hard drives, power supplies

### Environmental Benefits Tracking
- **CO2 Reduction**: Calculate carbon footprint savings
- **Metal Recovery**: Track valuable material recovery (gold, silver, copper)
- **Toxic Prevention**: Monitor hazardous material proper disposal
- **Plastic Recycling**: Measure plastic waste diversion from landfills

## 🛡️ Security Features

- **Input Sanitization**: Protection against SQL injection attacks
- **Password Hashing**: Secure password storage with PHP password_hash()
- **Session Security**: Timeout and secure session management
- **File Upload Validation**: Secure image upload with type checking
- **CSRF Protection**: Form token validation for secure submissions

## 🤝 Contributing

We welcome contributions to improve ELocate! Here's how you can help:

1. **Fork the Repository**
2. **Create Feature Branch**: `git checkout -b feature/AmazingFeature`
3. **Commit Changes**: `git commit -m 'Add some AmazingFeature'`
4. **Push to Branch**: `git push origin feature/AmazingFeature`
5. **Open Pull Request**

### Development Guidelines
- Follow PSR-12 coding standards for PHP
- Use semantic HTML5 elements
- Maintain responsive design principles
- Include comments for complex logic
- Test across multiple browsers

## 📄 License

This project is licensed under the MIT License.

## 🙏 Acknowledgments

- **Certified Recycling Partners**: 34+ verified e-waste facilities across Tamil Nadu
- **Environmental Organizations**: For guidelines and best practices
- **Open Source Community**: For the amazing tools and libraries used
- **Bootstrap Team**: For the responsive framework
- **Chart.js Contributors**: For data visualization capabilities

## 📈 Future Roadmap

### Planned Features
- [ ] **Mobile App**: Native iOS and Android applications
- [ ] **IoT Integration**: Smart bin monitoring and notifications
- [ ] **Blockchain Tracking**: Transparent recycling chain verification
- [ ] **AI Recommendations**: Smart facility suggestions based on user patterns
- [ ] **Multi-language Support**: Localization for regional languages
- [ ] **API Development**: Third-party integration capabilities

### Enhancements
- [ ] **Real-time Chat**: Customer support integration
- [ ] **Video Tutorials**: Interactive learning content
- [ ] **Gamification**: Enhanced reward system with leaderboards
- [ ] **Social Sharing**: Environmental impact sharing on social media
- [ ] **Advanced Analytics**: Detailed reporting and insights

---
**🌱 Join us in creating a sustainable future through responsible e-waste management! 🌱**
