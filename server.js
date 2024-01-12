import express from "express";
import dotenv from "dotenv";
import stripe from "stripe";

// Load variables
dotenv.config();

// Start server
const app = express();

app.use(express.static('catalog'));
app.use(express.json());

// Photos
app.use('/photos', express.static('photos'));

// Home route
app.get('/', (req, res) => {
    res.sendFile('catalog.html', { root: 'catalog' });
});

// Success route
app.get('/success', (req, res) => {
    res.sendFile('success.html', { root: 'catalog' });
});

// Cancel route
app.get('/cancel', (req, res) => {
    res.sendFile('cancel.html', { root: 'catalog' });
});

// Stripe configuration
let stripeGateway = stripe(process.env.stripe_api);
let DOMAIN = process.env.DOMAIN;

app.post('/stripe-checkout', async (req, res) => {
    const lineItems = req.body.items.map((item) => {
        const unitAmount = parseInt(item.price.replace(/[^0-9.-]+/g, '') * 100);
        console.log('item-price:', item.price);
        console.log('unitAmount:', unitAmount);
        return {
            price_data: {
                currency: 'usd',
                product_data: {
                    name: item.title,
                    images: [item.productImg]
                },
                unit_amount: unitAmount,
            },
            quantity: item.quantity,
        };
    });
    console.log('lineItems:', lineItems);

    // Create checkout session
    const session = await stripeGateway.checkout.sessions.create({
        payment_method_types: ['card'],
        mode: 'payment',
        success_url: `${DOMAIN}/success`,
        cancel_url: `${DOMAIN}/cancel`,
        line_items: lineItems,
        // Asking Address in Stripe Checkout Page
        billing_address_collection: 'required'
    });
    res.json({url: session.url});
});

app.listen(3000, () => {
    console.log('Listening on port 3000');
});
