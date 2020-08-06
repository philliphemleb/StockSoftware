import axios from "axios";

export default {
    async getItems(search, skip)
    {
        const { data } = await axios.get("http://192.168.0.26/StockSoftware/public/item?skip=" + skip + "&search=" + search)
        return data;
    }
}
