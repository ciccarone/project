<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Web Design',
                'Web Development',
                'Graphic Design',
                'SEO Services',
                'Content Writing',
                'Digital Marketing',
                'Social Media Management',
                'App Development',
                'Software Development',
                'IT Support',
                'Consulting',
                'Insurance',
                'Financial Planning',
                'Legal Services',
                'Real Estate',
                'Photography',
                'Videography',
                'Event Planning',
                'Catering',
                'Cleaning Services',
                'Landscaping',
                'Plumbing',
                'Electrical Services',
                'HVAC Services',
                'Roofing',
                'Construction',
                'Interior Design',
                'Tutoring',
                'Fitness Training',
                'Massage Therapy',
                'Chiropractic Services',
                'Medical Services',
                'Dental Services',
                'Veterinary Services',
                'Pet Grooming',
                'Automotive Repair',
                'Car Wash',
                'Transportation Services',
                'Travel Agency',
                'Tourism Services',
                'Translation Services',
                'Copywriting',
                'Branding',
                'Public Relations',
                'Advertising',
                'Market Research',
                'Business Coaching',
                'Life Coaching',
                'Career Counseling',
                'Resume Writing',
                'Job Placement',
                'Recruitment Services',
                'Human Resources',
                'Payroll Services',
                'Accounting',
                'Bookkeeping',
                'Tax Preparation',
                'Audit Services',
                'Investment Advice',
                'Wealth Management',
                'Estate Planning',
                'Mortgage Services',
                'Loan Services',
                'Credit Repair',
                'Debt Counseling',
                'Banking Services',
                'Merchant Services',
                'E-commerce Solutions',
                'Payment Processing',
                'Cybersecurity',
                'Network Administration',
                'Cloud Services',
                'Data Recovery',
                'Backup Solutions',
                'Web Hosting',
                'Domain Registration',
                'Email Marketing',
                'SMS Marketing',
                'Affiliate Marketing',
                'Influencer Marketing',
                'Video Production',
                'Podcast Production',
                'Voiceover Services',
                'Animation Services',
                '3D Modeling',
                'Virtual Reality',
                'Augmented Reality',
                'Game Development',
                'IT Training',
                'Project Management',
                'Supply Chain Management',
                'Logistics',
                'Warehouse Management',
                'Inventory Management',
                'Procurement Services',
                'Quality Assurance',
                'Compliance Services',
                'Risk Management',
                'Business Continuity',
                'Disaster Recovery',
                'Facility Management',
                'Security Services',
                'Surveillance',
                'Alarm Systems',
                'Fire Protection',
                'Health and Safety',
                'Environmental Services',
                'Waste Management',
                'Recycling Services',
                'Energy Management',
                'Sustainability Consulting',
                'Green Building',
                'Renewable Energy',
                'Solar Installation',
                'Wind Energy',
                'Hydropower',
                'Geothermal Energy',
                'Bioenergy',
                'Electric Vehicle Charging',
                'Smart Home Installation',
                'Home Automation',
                'Home Theater Installation',
                'Audio/Visual Services',
                'Lighting Design',
                'Sound Engineering',
                'Music Production',
                'DJ Services',
                'Live Event Production',
                'Stage Design',
                'Event Staffing',
                'Event Security',
                'Ticketing Services',
                'Venue Management',
                'Exhibition Services',
                'Trade Show Services',
                'Conference Services',
                'Meeting Planning',
                'Corporate Events',
                'Private Events',
                'Weddings',
                'Birthday Parties',
                'Anniversary Parties',
                'Baby Showers',
                'Bridal Showers',
                'Graduation Parties',
                'Holiday Parties',
                'Fundraisers',
                'Charity Events',
                'Non-Profit Services',
                'Volunteer Management',
                'Grant Writing',
                'Fundraising Consulting',
                'Donor Management',
                'Membership Management',
                'Advocacy Services',
                'Community Outreach',
                'Public Speaking',
                'Motivational Speaking',
                'Keynote Speaking',
                'Workshop Facilitation',
                'Training Services',
                'Educational Services',
                'Online Courses',
                'E-learning',
                'Instructional Design',
                'Curriculum Development',
                'Tutoring Services',
                'Test Preparation',
                'College Counseling',
                'Study Abroad Services',
                'Student Exchange Programs',
                'Language Instruction',
                'ESL Services',
                'Special Education',
                'Early Childhood Education',
                'Childcare Services',
                'Nanny Services',
                'Babysitting Services',
                'Elder Care',
                'Home Health Care',
                'Hospice Care',
                'Physical Therapy',
                'Occupational Therapy',
                'Speech Therapy',
                'Mental Health Services',
                'Counseling Services',
                'Psychotherapy',
                'Substance Abuse Counseling',
                'Rehabilitation Services',
                'Support Groups',
                'Crisis Intervention',
                'Hotline Services',
                'Peer Support',
                'Life Skills Training',
                'Job Training',
                'Vocational Rehabilitation',
                'Career Development',
                'Workforce Development',
                'Employment Services',
                'Job Placement Services',
                'Internship Programs',
                'Apprenticeship Programs',
                'Mentorship Programs',
                'Leadership Development',
                'Team Building',
                'Organizational Development',
                'Change Management',
                'Strategic Planning',
                'Business Development',
                'Market Expansion',
                'Product Development',
                'Innovation Consulting',
                'Technology Consulting',
                'Management Consulting',
                'Operations Consulting',
                'Financial Consulting',
                'Legal Consulting',
                'HR Consulting',
                'IT Consulting',
                'Marketing Consulting',
                'Sales Consulting',
                'Customer Service Consulting',
                'Public Relations Consulting',
                'Brand Consulting',
                'Design Consulting',
                'Creative Consulting',
                'Media Consulting',
                'Communications Consulting',
                'Event Consulting',
                'Travel Consulting',
                'Hospitality Consulting',
                'Retail Consulting',
                'Real Estate Consulting',
                'Construction Consulting',
                'Engineering Consulting',
                'Architectural Consulting',
                'Environmental Consulting',
                'Sustainability Consulting',
                'Energy Consulting',
                'Healthcare Consulting',
                'Pharmaceutical Consulting',
                'Biotech Consulting',
                'Medical Device Consulting',
                'Life Sciences Consulting',
                'Agricultural Consulting',
                'Food and Beverage Consulting',
                'Restaurant Consulting',
                'Culinary Consulting',
                'Nutrition Consulting',
                'Fitness Consulting',
                'Wellness Consulting',
                'Spa Consulting',
                'Beauty Consulting',
                'Fashion Consulting',
                'Personal Styling',
                'Image Consulting',
                'Wardrobe Consulting',
                'Personal Shopping',
                'Concierge Services',
                'Lifestyle Management',
                'Personal Assistant Services',
                'Errand Services',
                'Home Organization',
                'Decluttering Services',
                'Moving Services',
                'Relocation Services',
                'Storage Services',
                'Packing Services',
                'Unpacking Services',
                'Furniture Assembly',
                'Handyman Services',
                'Home Maintenance',
                'Home Repair',
                'Home Improvement',
                'Remodeling Services',
                'Renovation Services',
                'Interior Decorating',
                'Home Staging',
                'Property Management',
                'Real Estate Services',
                'Mortgage Services',
                'Title Services',
                'Escrow Services',
                'Appraisal Services',
                'Inspection Services',
                'Surveying Services',
                'Land Development',
                'Urban Planning',
                'Zoning Services',
                'Permitting Services',
                'Code Compliance',
                'Building Services',
                'Construction Management',
                'General Contracting',
                'Subcontracting',
                'Specialty Contracting',
                'Project Management',
                'Site Management',
                'Safety Management',
                'Quality Control',
                'Cost Estimation',
                'Scheduling Services',
                'Procurement Services',
                'Supply Chain Management',
                'Logistics Services',
                'Transportation Services',
                'Freight Services',
                'Shipping Services',
                'Courier Services',
                'Delivery Services',
                'Warehousing Services',
                'Inventory Management',
                'Order Fulfillment',
                'Distribution Services',
                'Import/Export Services',
                'Customs Brokerage',
                'Trade Compliance',
                'Regulatory Compliance',
                'Risk Management',
                'Insurance Services',
                'Claims Management',
                'Loss Prevention',
                'Disaster Recovery',
                'Business Continuity',
                'Crisis Management',
                'Emergency Management',
                'Security Services',
                'Surveillance Services',
                'Alarm Monitoring',
                'Access Control',
                'Fire Protection',
                'Life Safety',
                'Environmental Services',
                'Waste Management',
                'Recycling Services',
                'Hazardous Waste Disposal',
                'Industrial Cleaning',
                'Janitorial Services',
                'Pest Control',
                'Landscaping Services',
                'Grounds Maintenance',
                'Snow Removal',
                'Tree Services',
                'Lawn Care',
                'Irrigation Services',
                'Hardscaping Services',
                'Pool Services',
                'Spa Services',
                'Hot Tub Services',
                'Deck Services',
                'Fence Services',
                'Patio Services',
                'Outdoor Lighting',
                'Outdoor Kitchens',
                'Outdoor Living Spaces',
                'Playground Services',
                'Sports Court Services',
                'Golf Course Services',
                'Tennis Court Services',
                'Basketball Court Services',
                'Soccer Field Services',
                'Baseball Field Services',
                'Football Field Services',
                'Track and Field Services',
                'Stadium Services',
                'Arena Services',
                'Convention Center Services',
                'Exhibition Hall Services',
                'Trade Show Services',
                'Conference Services',
                'Meeting Services',
                'Event Planning',
                'Event Management',
                'Event Production',
                'Event Staffing',
                'Event Security',
                'Ticketing Services',
                'Venue Management',
                'Catering Services',
                'Food Services',
                'Beverage Services',
                'Bar Services',
                'Bartending Services',
                'Waitstaff Services',
                'Chef Services',
                'Personal Chef Services',
                'Meal Prep Services',
                'Dietary Services',
                'Nutrition Services',
                'Health Coaching',
                'Wellness Coaching',
                'Fitness Coaching',
                'Personal Training',
                'Group Fitness',
                'Yoga Instruction',
                'Pilates Instruction',
                'Dance Instruction',
                'Martial Arts Instruction',
                'Sports Coaching',
                'Athletic Training',
                'Physical Therapy',
                'Occupational Therapy',
                'Speech Therapy',
                'Massage Therapy',
                'Chiropractic Services',
                'Acupuncture Services',
                'Holistic Health Services',
                'Alternative Medicine',
                'Naturopathic Medicine',
                'Homeopathic Medicine',
                'Ayurvedic Medicine',
                'Traditional Chinese Medicine',
                'Herbal Medicine',
                'Nutritional Counseling',
                'Dietary Counseling',
                'Weight Loss Counseling',
                'Smoking Cessation',
                'Addiction Counseling',
                'Mental Health Counseling',
                'Psychotherapy',
                'Psychiatric Services',
                'Psychological Services',
                'Counseling Services',
                'Support Groups',
                'Crisis Intervention',
                'Hotline Services',
                'Peer Support',
                'Life Skills Training',
                'Job Training',
                'Vocational Rehabilitation',
                'Career Development',
                'Workforce Development',
                'Employment Services',
                'Job Placement Services',
                'Internship Programs',
                'Apprenticeship Programs',
                'Mentorship Programs',
                'Leadership Development',
                'Team Building',
                'Organizational Development',
                'Change Management',
                'Strategic Planning',
                'Business Development',
                'Market Expansion',
                'Product Development',
                'Innovation Consulting',
                'Technology Consulting',
                'Management Consulting',
                'Operations Consulting',
                'Financial Consulting',
                'Legal Consulting',
                'HR Consulting',
                'IT Consulting',
                'Marketing Consulting',
                'Sales Consulting',
                'Customer Service Consulting',
                'Public Relations Consulting',
                'Brand Consulting',
                'Design Consulting',
                'Creative Consulting',
                'Media Consulting',
                'Communications Consulting',
                'Event Consulting',
                'Travel Consulting',
                'Hospitality Consulting',
                'Retail Consulting',
                'Real Estate Consulting',
                'Construction Consulting',
                'Engineering Consulting',
                'Architectural Consulting',
                'Environmental Consulting',
                'Sustainability Consulting',
                'Energy Consulting',
                'Healthcare Consulting',
                'Pharmaceutical Consulting',
                'Biotech Consulting',
                'Medical Device Consulting',
                'Life Sciences Consulting',
                'Agricultural Consulting',
                'Food and Beverage Consulting',
                'Restaurant Consulting',
                'Culinary Consulting',
                'Nutrition Consulting',
                'Fitness Consulting',
                'Wellness Consulting',
                'Spa Consulting',
                'Beauty Consulting',
                'Fashion Consulting',
                'Personal Styling',
                'Image Consulting',
                'Wardrobe Consulting',
                'Personal Shopping',
                'Concierge Services',
                'Lifestyle Management',
                'Personal Assistant Services',
                'Errand Services',
                'Home Organization',
                'Decluttering Services',
                'Moving Services',
                'Relocation Services',
                'Storage Services',
                'Packing Services',
                'Unpacking Services',
                'Furniture Assembly',
                'Handyman Services',
                'Home Maintenance',
                'Home Repair',
                'Home Improvement',
                'Remodeling Services',
                'Renovation Services',
                'Interior Decorating',
                'Home Staging',
                'Property Management',
                'Real Estate Services',
                'Mortgage Services',
                'Title Services',
                'Escrow Services',
                'Appraisal Services',
                'Inspection Services',
                'Surveying Services',
                'Land Development',
                'Urban Planning',
                'Zoning Services',
                'Permitting Services',
                'Code Compliance',
                'Building Services',
                'Construction Management',
                'General Contracting',
                'Subcontracting',
                'Specialty Contracting',
                'Project Management',
                'Site Management',
                'Safety Management',
                'Quality Control',
                'Cost Estimation',
                'Scheduling Services',
                'Procurement Services',
                'Supply Chain Management',
                'Logistics Services',
                'Transportation Services',
                'Freight Services',
                'Shipping Services',
                'Courier Services',
                'Delivery Services',
                'Warehousing Services',
                'Inventory Management',
                'Order Fulfillment',
                'Distribution Services',
                'Import/Export Services',
                'Customs Brokerage',
                'Trade Compliance',
                'Regulatory Compliance',
                'Risk Management',
                'Insurance Services',
                'Claims Management',
                'Loss Prevention',
                'Disaster Recovery',
                'Business Continuity',
                'Crisis Management',
                'Emergency Management',
                'Security Services',
                'Surveillance Services',
                'Alarm Monitoring',
                'Access Control',
                'Fire Protection',
                'Life Safety',
                'Environmental Services',
                'Waste Management',
                'Recycling Services',
                'Hazardous Waste Disposal',
                'Industrial Cleaning',
                'Janitorial Services',
                'Pest Control',
                'Landscaping Services',
                'Grounds Maintenance',
                'Snow Removal',
                'Tree Services',
                'Lawn Care',
                'Irrigation Services',
                'Hardscaping Services',
                'Pool Services',
                'Spa Services',
                'Hot Tub Services',
                'Deck Services',
                'Fence Services',
                'Patio Services',
                'Outdoor Lighting',
                'Outdoor Kitchens',
                'Outdoor Living Spaces',
                'Playground Services',
                'Sports Court Services',
                'Golf Course Services',
                'Tennis Court Services',
                'Basketball Court Services',
                'Soccer Field Services',
                'Baseball Field Services',
                'Football Field Services',
                'Track and Field Services',
                'Stadium Services',
                'Arena Services',
                'Convention Center Services',
                'Exhibition Hall Services',
                'Trade Show Services',
                'Conference Services',
                'Meeting Services',
                'Event Planning',
                'Event Management',
                'Event Production',
                'Event Staffing',
                'Event Security',
                'Ticketing Services',
                'Venue Management',
                'Catering Services',
                'Food Services',
                'Beverage Services',
                'Bar Services',
                'Bartending Services',
                'Waitstaff Services',
                'Chef Services',
                'Personal Chef Services',
                'Meal Prep Services',
                'Dietary Services',
                'Nutrition Services',
                'Health Coaching',
                'Wellness Coaching',
                'Fitness Coaching',
                'Personal Training',
                'Group Fitness',
                'Yoga Instruction',
                'Pilates Instruction',
                'Dance Instruction',
                'Martial Arts Instruction',
                'Sports Coaching',
                'Athletic Training',
                'Physical Therapy',
                'Occupational Therapy',
                'Speech Therapy',
                'Massage Therapy',
                'Chiropractic Services',
                'Acupuncture Services',
                'Holistic Health Services',
                'Alternative Medicine',
                'Naturopathic Medicine',
                'Homeopathic Medicine',
                'Ayurvedic Medicine',
                'Traditional Chinese Medicine',
                'Herbal Medicine',
                'Nutritional Counseling',
                'Dietary Counseling',
                'Weight Loss Counseling',
                'Smoking Cessation',
                'Addiction Counseling',
                'Mental Health Counseling',
                'Psychotherapy',
                'Psychiatric Services',
                'Psychological Services',
                'Counseling Services',
                'Support Groups',
                'Crisis Intervention',
                'Hotline Services',
                'Peer Support',
                'Life Skills Training',
                'Job Training',
                'Vocational Rehabilitation',
                'Career Development',
                'Workforce Development',
                'Employment Services',
                'Job Placement Services',
                'Internship Programs',
                'Apprenticeship Programs',
                'Mentorship Programs',
                'Leadership Development',
                'Team Building',
                'Organizational Development',
                'Change Management',
                'Strategic Planning',
                'Business Development',
                'Market Expansion',
                'Product Development',
                'Innovation Consulting',
                'Technology Consulting',
                'Management Consulting',
                'Operations Consulting',
                'Financial Consulting',
                'Legal Consulting',
                'HR Consulting',
                'IT Consulting',
                'Marketing Consulting',
                'Sales Consulting',
                'Customer Service Consulting',
                'Public Relations Consulting',
                'Brand Consulting',
                'Design Consulting',
                'Creative Consulting',
                'Media Consulting',
                'Communications Consulting',
                'Event Consulting',
                'Travel Consulting',
                'Hospitality Consulting',
                'Retail Consulting',
                'Real Estate Consulting',
                'Construction Consulting',
                'Engineering Consulting',
                'Architectural Consulting',
                'Environmental Consulting',
                'Sustainability Consulting',
                'Energy Consulting',
                'Healthcare Consulting',
                'Pharmaceutical Consulting',
                'Biotech Consulting',
                'Medical Device Consulting',
                'Life Sciences Consulting',
                'Agricultural Consulting',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}


