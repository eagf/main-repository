import React, { useEffect, useState } from 'react';
import '../styles/CookieConsent.css';

const CookieConsent = () => {
    const [show, setShow] = useState(false);

    useEffect(() => {
        const consent = localStorage.getItem('cookieConsent');
        if (consent !== 'accepted') {
            setShow(true);
        }
    }, []);

    const handleAccept = () => {
        localStorage.setItem('cookieConsent', 'accepted');
        setShow(false);
    };

    const handleReject = () => {
        // Handle cookie rejection logic
        setShow(false);
    };

    if (!show) return null;

    return (
        <div className="cookie-consent-container">
            <p>This website uses cookies to ensure you get the best experience on our website.</p>
            <div className="cookie-consent-buttons">
                <button className="cookie-button" onClick={handleAccept}>Accept</button>
                <button className="cookie-button" onClick={handleReject}>Reject</button>
            </div>
        </div>
    );
};

export default CookieConsent;
