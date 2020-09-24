import axios from "axios";

export default {
    async fetchItems(search, skip)
    {
        const { data } = await axios.get("http://localhost/StockSoftware/public/item?skip=" + skip + "&search=" + search)
        return data;
    }
}
