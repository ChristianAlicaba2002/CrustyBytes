import { useParams } from "react-router-dom"

export default function CheckoutPreview() {
    const { id } = useParams();
    console.log(id)
    return (
        <div>
        </div>
    )
}
