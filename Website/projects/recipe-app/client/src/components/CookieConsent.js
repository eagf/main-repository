import React, { useState } from 'react';
import '../styles/CookieConsent.css';

const CookieConsent = () => {
    const [show, setShow] = useState(true); // State to toggle visibility

    if (!show) return null;

    const handleAccept = () => {
        // Handle cookie acceptance logic
        setShow(false);
    };

    const handleReject = () => {
        // Handle cookie rejection logic
        setShow(false);
    };

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