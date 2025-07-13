export type TUser = {
    uId: string;
    name: string;
    phone_number?: string;
    city?: string;
    barangay?: string;
    purok?: string;
    email: string;
    password: string;
    image?: string;
}
export type TProducts = {
    id: number;
    name: string;
    description: string;
    category?: string;
    size?: string;
    price: number;
    image?: string;
    is_available?: boolean;
}
export type TCartItem = TProducts &  TUser &{
    quantity: number
}

export type Orders = TCartItem & {
status: string,
payment_method: string,
}